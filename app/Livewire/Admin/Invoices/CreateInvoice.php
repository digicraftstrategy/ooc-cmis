<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\PremisesOwner;
use App\Models\PublicationPremises;
use App\Models\Classification;
use App\Models\PrescribedActivity;
use App\Models\PrescribedActivityType;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateInvoice extends Component
{
    public string $invoice_type = 'premises'; // 'premises' | 'classification'
    public ?string $invoice_date = null;
    public ?string $due_date = null;

    public ?int $owner_id = null;
    public ?int $premises_id = null;

    public ?string $billing_email = null;
    public ?string $billing_address = null;
    public ?string $notes = null;

    public string $status = Invoice::STATUS_PENDING;

    public float $subtotal = 0;
    public float $tax = 0;
    public float $total = 0;

    public $owners = [];
    public $premisesOptions = [];
    public $classificationItems = [];
    public $availableActivities;

    public array $items = [];

    public function mount(): void
    {
        $today = now();
        $this->invoice_date = $today->toDateString();
        $this->due_date = $today->copy()->addDays(30)->toDateString();

        $this->loadDropdowns();
        $this->loadActivitiesForType();

        $this->addItemRow();
    }

    protected function loadDropdowns(): void
    {
        $this->owners = PremisesOwner::orderBy('owners_name')->get();
        $this->loadPremisesForOwner();

        // Load classification items with their relationships for better display
        $this->classificationItems = Classification::with(['classifiable', 'rating', 'category'])
            ->orderBy('id', 'desc')
            ->get();
    }

    protected function loadPremisesForOwner(): void
    {
        if ($this->owner_id) {
            $this->premisesOptions = PublicationPremises::where('premises_owner_id', $this->owner_id)
                ->orderBy('premises_name')
                ->get();
        } else {
            $this->premisesOptions = collect();
        }
    }

    protected function loadActivitiesForType(): void
    {
        $typeName = $this->invoice_type === 'premises'
            ? 'Registration of Publication Premises'
            : 'Classification of Films & Publications';

        $type = PrescribedActivityType::where('type', $typeName)->first();

        $this->availableActivities = $type
            ? PrescribedActivity::where('prescribed_activity_type_id', $type->id)
                ->where('is_active', true)
                ->orderBy('activity_type')
                ->get()
            : collect();
    }

    public function updated($name, $value): void
    {
        if ($name === 'invoice_type') {
            $this->onInvoiceTypeChanged();
        }

        if ($name === 'owner_id') {
            $this->onOwnerChanged();
        }

        if (str_starts_with($name, 'items.') || $name === 'tax') {
            $this->recalculateTotals();
        }
    }

    protected function onInvoiceTypeChanged(): void
    {
        $this->premises_id = null;
        $this->items = [];
        $this->subtotal = 0;
        $this->tax = 0;
        $this->total = 0;

        $this->loadActivitiesForType();
        $this->addItemRow();
    }

    protected function onOwnerChanged(): void
    {
        // Reset premises when owner changes
        $this->premises_id = null;

        // Load premises for the selected owner
        $this->loadPremisesForOwner();

        if (! $this->owner_id) {
            return;
        }

        $owner = PremisesOwner::find($this->owner_id);

        if ($owner) {
            $this->billing_email   = $owner->email   ?? $this->billing_email;
            $this->billing_address = $owner->address ?? $this->billing_address;
        }
    }

    public function addItemRow(): void
    {
        $this->items[] = [
            'prescribed_activity_id' => null,
            'classification_item_id' => null,
            'description'            => '',
            'quantity'               => 1,
            'unit_amount'            => 0,
            'line_total'             => 0,
        ];
    }

    public function removeItemRow(int $index): void
    {
        if (! isset($this->items[$index])) {
            return;
        }

        unset($this->items[$index]);
        $this->items = array_values($this->items);

        $this->recalculateTotals();
    }

    protected function recalculateTotals(): void
    {
        $subtotal = 0;

        foreach ($this->items as $i => &$item) {
            // Auto-populate from activity if selected
            if (! empty($item['prescribed_activity_id'])) {
                $act = $this->availableActivities
                    ->firstWhere('id', (int) $item['prescribed_activity_id']);

                if ($act) {
                    if (empty($item['unit_amount']) || $item['unit_amount'] == 0) {
                        $item['unit_amount'] = (float) $act->prescribed_fee;
                    }

                    if (empty($item['description'])) {
                        $item['description'] = $act->activity_type;
                    }
                }
            }

            $qty   = max(1, (int) ($item['quantity'] ?? 1));
            $unit  = (float) ($item['unit_amount'] ?? 0);
            $item['quantity']   = $qty;
            $item['line_total'] = $qty * $unit;

            $subtotal += $item['line_total'];
        }

        $this->items = $this->items;
        $this->subtotal = $subtotal;
        $this->total    = $this->subtotal + (float) $this->tax;
    }

    protected function rules(): array
    {
        $rules = [
            'invoice_type'  => 'required|in:premises,classification',
            'invoice_date'  => 'required|date',
            'due_date'      => 'required|date|after_or_equal:invoice_date',
            'owner_id'      => 'required|exists:premises_owners,id',
            'premises_id'   => 'required_if:invoice_type,premises|nullable|exists:premises,id',
            'billing_email' => 'nullable|email',
            'billing_address' => 'nullable|string',
            'notes'         => 'nullable|string',
            'tax'           => 'nullable|numeric|min:0',

            'items'                          => 'required|array|min:1',
            'items.*.prescribed_activity_id' => 'required|exists:prescribed_activities,id',
            'items.*.description'            => 'required|string',
            'items.*.quantity'               => 'required|integer|min:1',
            'items.*.unit_amount'            => 'required|numeric|min:0',
        ];

        // For classification invoices, each line item MUST have a classification_item_id
        if ($this->invoice_type === 'classification') {
            $rules['items.*.classification_item_id'] = 'required|exists:classifications,id';
        }

        return $rules;
    }

    protected function validationAttributes(): array
    {
        return [
            'owner_id' => 'owner',
            'premises_id' => 'premises',
            'invoice_date' => 'invoice date',
            'due_date' => 'due date',
            'items.*.prescribed_activity_id' => 'activity',
            'items.*.classification_item_id' => 'classification item',
            'items.*.description' => 'description',
            'items.*.quantity' => 'quantity',
            'items.*.unit_amount' => 'unit amount',
        ];
    }

    protected function generateInvoiceNumber(): string
    {
        return 'INV-' . now()->format('YmdHis') . '-' . random_int(100, 999);
    }

    public function save(): void
    {
        $this->recalculateTotals();
        $this->validate();

        DB::beginTransaction();

        try {
            $invoice = new Invoice();
            $invoice->invoice_number = $this->generateInvoiceNumber();
            $invoice->invoice_date   = $this->invoice_date;
            $invoice->due_date       = $this->due_date;
            $invoice->invoice_type   = $this->invoice_type;
            $invoice->subtotal       = $this->subtotal;
            $invoice->tax            = $this->tax;
            $invoice->total          = $this->total;
            $invoice->billing_email  = $this->billing_email;
            $invoice->billing_address= $this->billing_address;
            $invoice->status         = $this->status;
            $invoice->notes          = $this->notes;
            $invoice->owner_id       = $this->owner_id;
            $invoice->premises_id    = $this->invoice_type === 'premises' ? $this->premises_id : null;
            $invoice->save();

            foreach ($this->items as $row) {
                $item = new InvoiceItem();
                $item->invoice_id            = $invoice->id;
                $item->prescribed_activity_id= $row['prescribed_activity_id'];
                $item->classification_item_id= $this->invoice_type === 'classification'
                    ? ($row['classification_item_id'] ?? null)
                    : null;
                $item->description           = $row['description'];
                $item->quantity              = $row['quantity'];
                $item->unit_amount           = $row['unit_amount'];
                $item->line_total            = $row['line_total'];
                $item->save();
            }

            DB::commit();

            session()->flash('message', 'Invoice created successfully.');

            // Reset form but maintain invoice type
            $type = $this->invoice_type;
            $this->reset();
            $this->invoice_type = $type;
            $this->status = Invoice::STATUS_PENDING;
            $this->mount();
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            $this->addError('general', 'Failed to create invoice. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.admin.invoices.create-invoice');
    }
}
