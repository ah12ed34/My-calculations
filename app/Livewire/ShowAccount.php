<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\TransactionLog;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ShowAccount extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public Customer $customer;
    public function render()
    {
        $transactionLogs = TransactionLog::where('customer_id', $this->customer->id)
        ->orderByDesc('id')
        ->paginate(5);

        return view('livewire.show-account', ['totalTransactionLogs'=>TransactionLog::where('customer_id', $this->customer->id)->count()
                                                ,'transactionLogs' => $transactionLogs]);
    }
}