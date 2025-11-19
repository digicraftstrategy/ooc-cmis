<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

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
        'invoiceCreated' => '$refresh', // if you emit this from CreateInvoice, the table will update
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
        return Invoice::with(['owner', 'premises', 'items'])
            ->when($this->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('invoice_number', 'like', "%{$search}%")
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

    public function render()
    {
        $invoices = $this->getInvoicesQuery()->paginate($this->perPage);

        return view('livewire.admin.invoices.invoice-table', [
            'invoices' => $invoices,
        ]);
    }
}
