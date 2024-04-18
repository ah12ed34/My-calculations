<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TransactionLog as TransactionLogModel;
use Illuminate\Routing\Route;

class TransactionLog extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $transactionLogs;
    public $id;
    public $parePage = 5;

    public function mount(){
        $re = request('parepage');
        if($re){
            // check if the request is not null and is numeric
            if(is_numeric($re)){
                $this->parePage = $re;
            }else{
                // dd();
                return redirect()->route(request()->route()->getName(),
                array_merge(request()->except('parepage'),['parepage' => $this->parePage],request()->route()->parameters())
            );
            }

        }

    }
    public function getLogsProperty(){
        return TransactionLogModel::where('customer_id',$this->id)
        ->orderByDesc('id')
        ->paginate($this->parePage);
    }
    public function render()
    {
        return view('livewire.transaction-log',[
            'logs' => $this->Logs
        ]);
    }
}
