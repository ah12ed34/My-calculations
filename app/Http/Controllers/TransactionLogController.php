<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Models\TransactionLog;
use App\Models\Customer;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class TransactionLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected int $id = 0;
    function __construct(){
        $this->middleware('auth');
        $this->id = request("id",0);
        // $id = request()->route('id');
        $this->middleware('custM:'.$this->id);
    }

    public function index()
    {
        // dd(TransactionLog::find($id)->first()->customer->user_id);
        $id = $this->id;
            $transactionLogs = TransactionLog::all()->whereIn('customer_id', $id);
            $customer = Customer::find($id);
            return view('transactionLogs.index', compact('transactionLogs', 'id','customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = $this->id;
        //
        return view('transactionLogs.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $id = $this->id;
        //dd($request->all());
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'type' => 'required|in:deposit,withdraw',
            'currency' => 'required|in:usd,yr,sr',
            'status' => 'required|in:pending,cancelled,completed',
            'description' => 'nullable',
            // 'date' => 'required|date',
            
        ]);

        $transactionLog = new TransactionLog();
        $transactionLog->customer_id = $id;
        $transactionLog->title = $request->title;
        $transactionLog->amount = $request->amount;
        $transactionLog->type = $request->type;
        $transactionLog->currency = $request->currency;
        $transactionLog->description = $request->description;
        $transactionLog->status = $request->status;
        $transactionLog->request_date = $request->request_date;
        // return gettype($request->request_date);
        if($transactionLog->save()){
            $customer = Customer::find($id);
            switch($request->currency){
                case 'usd':        
                    if($request->type === 'deposit'){
                        $customer->amount_usd +=  $request->amount;
                    }elseif($request->type === 'withdraw'){
                        $customer->amount_usd -=  $request->amount;
                    }
                    $customer->save();
                    break;
                case 'yr':
                    if($request->type === 'deposit'){
                        $customer->amount_yr +=  $request->amount;
                    }elseif($request->type === 'withdraw'){
                        $customer->amount_yr -=  $request->amount;
                    }
                    $customer->save();
                    break;
                case 'sr':
                    if($request->type === 'deposit'){
                        $customer->amount_sr +=  $request->amount;
                    }elseif($request->type === 'withdraw'){
                        $customer->amount_sr -=  $request->amount;
                    }
                    $customer->save();
                    break;
            }
        }else{
            return error("Error in saving transaction log");
        }
        return redirect()->route('transactionLogs.index', compact('id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionLog $transactionLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,TransactionLog $transactionLog)
    {
        //
        $customer_Id = $id;
        return view('transactionLogs.edit', compact('id', 'transactionLog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id, TransactionLog $transactionLog)
    {
        //
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'type' => 'required|in:deposit,withdraw',
            'currency' => 'required|in:usd,yr,sr',
            'status' => 'required|in:pending,cancelled,completed',
            'description' => 'nullable',
            // 'date' => 'required|date',
            
        ]);
        // $oldAmount = $transactionLog->amount;
        // $oldCurrency = $transactionLog->currency;
        // $oldType = $transactionLog->type;
        // // $customer_Id = $id;
        // $transactionLog->title = $request->title;
        // $transactionLog->amount = $request->amount;
        // $transactionLog->type = $request->type;
        // $transactionLog->currency = $request->currency;
        // $transactionLog->description = $request->description;
        // $transactionLog->status = $request->status;
        // $transactionLog->request_date = $request->request_date;
        // ;
        // if($transactionLog->save()){
        //     $customer = Customer::find($id);
        //         if($oldCurrency == $request->currency){
        //             if($oldAmount != $request->amount){
        //             switch($request->currency){
        //         case 'usd':        
        //             if($request->type === 'deposit'){
        //                 $customer->amount_usd +=  ($request->amount-$oldAmount);
        //             }elseif($request->type === 'withdraw'){
        //                 $customer->amount_usd -=  ($request->amount-$oldAmount);
        //             }
        //             $customer->save();
        //             break;
        //         case 'yr':
        //             if($request->type === 'deposit'){
        //                 $customer->amount_yr += ($request->amount-$oldAmount);
        //             }elseif($request->type === 'withdraw'){
        //                 $customer->amount_yr -=  ($request->amount-$oldAmount);
        //             }
        //             $customer->save();
        //             break;
        //         case 'sr':
        //             if($request->type === 'deposit'){
        //                 $customer->amount_sr +=  ($request->amount-$oldAmount);
        //             }elseif($request->type === 'withdraw'){
        //                 $customer->amount_sr -=  ($request->amount-$oldAmount);
        //             }
        //             $customer->save();
        //             break;
        //             }
        //             }
        //     }else{
        //             switch($oldCurrency){
        //         case 'usd':        
        //             if($oldType === 'deposit'){
        //                 $customer->amount_usd -=  $oldAmount;
        //             }elseif($oldType === 'withdraw'){
        //                 $customer->amount_usd +=  $oldAmount;
        //             }
        //             switch($request->currency){
        //                 case 'yr':
        //                     if($request->type === 'deposit'){
        //                         $customer->amount_yr +=  $request->amount;
        //                     }elseif($request->type === 'withdraw'){
        //                         $customer->amount_yr -=  $request->amount;
        //                     }
        //                     break;
        //                 case 'sr':
        //                     if($request->type === 'deposit'){
        //                             $customer->amount_sr +=  $request->amount;
        //                     }elseif($request->type === 'withdraw'){
        //                             $customer->amount_sr -=  $request->amount;
        //                     }
        //                         break;
        //             }
        //             $customer->save();
        //             break;
        //         case 'yr':
        //             if($oldType === 'deposit'){
        //                 $customer->amount_yr -=  $oldAmount;
        //             }elseif($oldType === 'withdraw'){
        //                 $customer->amount_yr +=  $oldAmount;
        //             }
        //             switch($request->currency){
        //                 case 'usd':
        //                     if($request->type === 'deposit'){
        //                         $customer->amount_usd +=  $request->amount;
        //                     }elseif($request->type === 'withdraw'){
        //                         $customer->amount_usd -=  $request->amount;
        //                     }
        //                     break;
        //                 case 'sr':
        //                     if($request->type === 'deposit'){
        //                             $customer->amount_sr +=  $request->amount;
        //                     }elseif($request->type === 'withdraw'){
        //                             $customer->amount_sr -=  $request->amount;
        //                     }
        //                         break;
        //             }
        //             $customer->save();
        //             break;
        //         case 'sr':
        //             if($oldType === 'deposit'){
        //                 $customer->amount_sr -=  $oldAmount;
        //             }elseif($oldType === 'withdraw'){
        //                 $customer->amount_sr +=  $oldAmount;
        //             }
        //             switch($request->currency){
        //                 case 'usd':
        //                     if($request->type === 'deposit'){
        //                         $customer->amount_usd +=  $request->amount;
        //                     }elseif($request->type === 'withdraw'){
        //                         $customer->amount_usd -=  $request->amount;
        //                     }
        //                     break;
        //                 case 'yr':
        //                     if($request->type === 'deposit'){
        //                             $customer->amount_yr +=  $request->amount;
        //                     }elseif($request->type === 'withdraw'){
        //                             $customer->amount_yr -=  $request->amount;
        //                     }
        //                         break;
        //             }
        //             $customer->save();
        //             break;
        //     }
                
        //     }
        //     }else{
        //     return error("Error in saving transaction log");
        // }
        $transactionLog->title = $request->title;
        $transactionLog->description = $request->description;
        $transactionLog->status = $request->status;
        $transactionLog->request_date = $request->request_date;
            if($transactionLog->change(Customer::find($id),$request->type,$request->currency,$request->amount)){
                return redirect()->route('transactionLogs.index', compact('id'));
            }else{
                return error("Error in saving transaction log");
            }
        //return redirect()->route('transactionLogs.index', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,TransactionLog $transactionLog)
    {
        //
        // $customer_Id = $id;
        $amount = $transactionLog->amount ;
        $type = $transactionLog->type ;
        $currency = $transactionLog->currency ;

        if($amount > 0 && $transactionLog->delete()){
            $customer = Customer::find($id);
        switch($currency){
            case 'usd':        
                if($type === 'deposit'){
                    $customer->amount_usd -=  ($amount);
                }elseif($type === 'withdraw'){
                    $customer->amount_usd +=  ($amount);
                }
                $customer->save();
                break;
            case 'yr':
                if($type === 'deposit'){
                    $customer->amount_yr -= ($amount);
                }elseif($type === 'withdraw'){
                    $customer->amount_yr +=  ($amount);
                }
                $customer->save();
                break;
            case 'sr':
                if($type === 'deposit'){
                    $customer->amount_sr -=  ($amount);
                }elseif($type === 'withdraw'){
                    $customer->amount_sr +=  ($amount);
                }
                $customer->save();
                break;
            }
    }
        return redirect()->route('transactionLogs.index',compact('id'));
    }

}
