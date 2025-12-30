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
    function __construct()
    {
        $this->middleware('auth');
        $this->id = request("id", 0);
        // $id = request()->route('id');
        $this->middleware('custM:' . $this->id);
    }

    public function index()
    {
        // dd(TransactionLog::find($id)->first()->customer->user_id);
        $id = $this->id;
        $transactionLogs = TransactionLog::all()->whereIn('customer_id', $id);
        $customer = Customer::find($id);
        return view('transactionLogs.index', compact('transactionLogs', 'id', 'customer'));
    }

    public function chanegeCurrencyDefault(Request $request)
    {
        $request->validate([
            'currency_default' => 'required|in:usd,yr,sr,egp,try',
        ]);
        $customer = Customer::find($this->id);
        $customer->currency_default = $request->currency_default;
        $customer->save();
        return redirect()->route('transactionLogs.index', ['id' => $this->id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = $this->id;
        $currency_default = Customer::find($id)->currency_default;
        //
        return view('transactionLogs.create', compact('id', 'currency_default'));
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
            'currency' => 'required|in:usd,yr,sr,egp,try',
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
        if ($transactionLog->save()) {
            $customer = Customer::find($id);
            // switch ($request->currency) {
            //     case 'usd':
            //         if ($request->type === 'deposit') {
            //             $customer->amount_usd +=  $request->amount;
            //         } elseif ($request->type === 'withdraw') {
            //             $customer->amount_usd -=  $request->amount;
            //         }
            //         $customer->save();
            //         break;
            //     case 'yr':
            //         if ($request->type === 'deposit') {
            //             $customer->amount_yr +=  $request->amount;
            //         } elseif ($request->type === 'withdraw') {
            //             $customer->amount_yr -=  $request->amount;
            //         }
            //         $customer->save();
            //         break;
            //     case 'sr':
            //         if ($request->type === 'deposit') {
            //             $customer->amount_sr +=  $request->amount;
            //         } elseif ($request->type === 'withdraw') {
            //             $customer->amount_sr -=  $request->amount;
            //         }
            //         $customer->save();
            //         break;
            //     case 'egp':
            //         if ($request->type === 'deposit') {
            //             $customer->amount_egp +=  $request->amount;
            //         } elseif ($request->type === 'withdraw') {
            //             $customer->amount_egp -=  $request->amount;
            //         }
            //         $customer->save();
            //         break;
            //     case 'try':
            //         if ($request->type === 'deposit') {
            //             $customer->amount_try +=  $request->amount;
            //         } elseif ($request->type === 'withdraw') {
            //             $customer->amount_try -=  $request->amount;
            //         }
            //         $customer->save();
            //         break;
            // }
            $customer->adjustBalance($request->currency, $request->amount, $request->type);
        } else {
            return error("Error in saving transaction log");
        }
        return redirect()->route('transactionLogs.index', compact('id'));
    }

    /**
     * Display the specified resource.
     */
    // public function show(Request $request)
    // {
    //     //
    //     // dd($customer_Id, $request->transactionLog);
    //     $transactionLog = TransactionLog::find($request->transactionLog);
    //     return view('transactionLogs.show', compact('transactionLog'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, TransactionLog $transactionLog)
    {
        //
        $customer_Id = $id;
        return view('transactionLogs.edit', compact('id', 'transactionLog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, TransactionLog $transactionLog)
    {
        //
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'type' => 'required|in:deposit,withdraw',
            'currency' => 'required|in:usd,yr,sr,egp,try',
            'status' => 'required|in:pending,cancelled,completed',
            'description' => 'nullable',
            // 'date' => 'required|date',

        ]);

        $transactionLog->title = $request->title;
        $transactionLog->description = $request->description;
        $transactionLog->status = $request->status;
        $transactionLog->request_date = $request->request_date;
        if ($transactionLog->change(Customer::find($id), $request->type, $request->currency, $request->amount)) {
            return redirect()->route('transactionLogs.index', compact('id'));
        } else {
            return error("Error in saving transaction log");
        }
        //return redirect()->route('transactionLogs.index', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, TransactionLog $transactionLog)
    {
        //
        // $customer_Id = $id;
        $amount = $transactionLog->amount;
        $type = $transactionLog->type;
        $currency = $transactionLog->currency;

        if ($amount > 0 && $transactionLog->delete()) {
            $customer = Customer::find($id);
            // switch ($currency) {
            //     case 'usd':
            //         if ($type === 'deposit') {
            //             $customer->amount_usd -=  ($amount);
            //         } elseif ($type === 'withdraw') {
            //             $customer->amount_usd +=  ($amount);
            //         }
            //         $customer->save();
            //         break;
            //     case 'yr':
            //         if ($type === 'deposit') {
            //             $customer->amount_yr -= ($amount);
            //         } elseif ($type === 'withdraw') {
            //             $customer->amount_yr +=  ($amount);
            //         }
            //         $customer->save();
            //         break;
            //     case 'sr':
            //         if ($type === 'deposit') {
            //             $customer->amount_sr -=  ($amount);
            //         } elseif ($type === 'withdraw') {
            //             $customer->amount_sr +=  ($amount);
            //         }
            //         $customer->save();
            //         break;
            //     case 'egp':
            //         if ($type === 'deposit') {
            //             $customer->amount_egp -=  ($amount);
            //         } elseif ($type === 'withdraw') {
            //             $customer->amount_egp +=  ($amount);
            //         }
            //         $customer->save();
            //         break;
            //     case 'try':
            //         if ($type === 'deposit') {
            //             $customer->amount_try -=  ($amount);
            //         } elseif ($type === 'withdraw') {
            //             $customer->amount_try +=  ($amount);
            //         }
            //         $customer->save();
            //         break;
            // }
            $customer->adjustBalance($currency, $amount, $type == 'deposit' ? 'withdraw' : 'deposit');
        }
        return redirect()->route('transactionLogs.index', compact('id'));
    }

    public function recalculate($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->recalculateBalances();

        return redirect()
            ->route('transactionLogs.index', ['id' => $id])
            ->with('success', 'تمت إعادة حساب العمليات بنجاح');
    }
}
