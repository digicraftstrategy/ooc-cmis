<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class InvoiceTable extends Component
{
    use WithPagination;

    public string $search = '';
    public ?string $statusFilter = null;        // pending, paid, cancelled, overdue
    public ?string $typeFilter = null;          // premises, classification
    public int $perPage = 10;

    public string $sortField = 'invoice_date';
    public string $sortDirection = 'desc';

    protected $queryString = [
        'search'       => ['except' => ''],
        'statusFilter' => ['except' => null],
        'typeFilter'   => ['except' => null],
        'sortField'    => ['except' => 'invoice_date'],
        'sortDirection'=> ['except' => 'desc'],
        'page'         => ['except' => 1],
    ];

    protected $listeners = [
        'invoiceCreated' => '$refresh',
        'invoiceUpdated' => '$refresh',
        'invoiceDeleted' => '$refresh',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingTypeFilter(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    protected function getInvoicesQuery()
    {
        return Invoice::with([
                'owner',
                'premises',
                'items' => function ($query) {
                    $query->with(['classificationItem' => function ($q) {
                        $q->with('classifiable'); // Load the polymorphic relationship
                    }]);
                }
            ])
            ->when($this->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('invoice_number', 'like', "%{$search}%")
                      ->orWhere('billing_email', 'like', "%{$search}%")
                      ->orWhereHas('owner', function ($q2) use ($search) {
                          $q2->where('owners_name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('premises', function ($q3) use ($search) {
                          $q3->where('premises_name', 'like', "%{$search}%");
                      });
                });
            })
            ->when($this->statusFilter, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($this->typeFilter, function ($query, $type) {
                $query->where('invoice_type', $type);
            })
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function deleteInvoice(int $invoiceId): void
    {
        try {
            $invoice = Invoice::findOrFail($invoiceId);

            DB::beginTransaction();

            // Delete invoice items first
            $invoice->items()->delete();

            // Delete the invoice
            $invoice->delete();

            DB::commit();

            session()->flash('message', 'Invoice deleted successfully.');

            $this->dispatch('invoiceDeleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            session()->flash('error', 'Failed to delete invoice. Please try again.');
        }
    }

    public function markAsPaid(int $invoiceId): void
    {
        try {
            $invoice = Invoice::findOrFail($invoiceId);
            $invoice->markAsPaid();

            session()->flash('message', 'Invoice marked as paid successfully.');

            $this->dispatch('invoiceUpdated');
        } catch (\Throwable $e) {
            report($e);
            session()->flash('error', 'Failed to update invoice status.');
        }
    }

    public function markAsCancelled(int $invoiceId): void
    {
        try {
            $invoice = Invoice::findOrFail($invoiceId);
            $invoice->markAsCancelled();

            session()->flash('message', 'Invoice cancelled successfully.');

            $this->dispatch('invoiceUpdated');
        } catch (\Throwable $e) {
            report($e);
            session()->flash('error', 'Failed to cancel invoice.');
        }
    }

    public function getStats()
    {
        $baseQuery = Invoice::query();

        // Apply filters to stats
        if ($this->search) {
            $baseQuery->where(function ($q) {
                $q->where('invoice_number', 'like', "%{$this->search}%")
                  ->orWhere('billing_email', 'like', "%{$this->search}%")
                  ->orWhereHas('owner', function ($q2) {
                      $q2->where('owners_name', 'like', "%{$this->search}%");
                  })
                  ->orWhereHas('premises', function ($q3) {
                      $q3->where('premises_name', 'like', "%{$this->search}%");
                  });
            });
        }

        if ($this->typeFilter) {
            $baseQuery->where('invoice_type', $this->typeFilter);
        }

        return [
            'total' => (clone $baseQuery)->count(),
            'paid' => (clone $baseQuery)->where('status', Invoice::STATUS_PAID)->count(),
            'pending' => (clone $baseQuery)->where('status', Invoice::STATUS_PENDING)->count(),
            'overdue' => (clone $baseQuery)->where('status', Invoice::STATUS_OVERDUE)->count(),
            'cancelled' => (clone $baseQuery)->where('status', Invoice::STATUS_CANCELLED)->count(),
        ];
    }

    public function render()
    {
        $invoices = $this->getInvoicesQuery()->paginate($this->perPage);
        $stats = $this->getStats();

        return view('livewire.admin.invoices.invoice-table', [
            'invoices' => $invoices,
            'stats' => $stats,
        ]);
    }
}
