<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\TransactionLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ShowAccont extends Controller
{
    //

    public function index()
    {
        return view('display.index');
    }
    public function showTransactionLogs(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $customer = Customer::where('email', $request->email)->first();
        if ($customer) {
            if ($request->password != null && Hash::check($request->password, $customer->password)) {
                return view('display.show', compact('customer'));
            } else {
                return  "Error in login password";
            }
        } else
            return  "Error in login";
    }

    public function show(Request $request)
    {
        //
        // dd($customer_Id, $request->transactionLog);
        $transactionLog = TransactionLog::find($request->transactionLog);
        return view('transactionLogs.show', compact('transactionLog'));
    }
}
