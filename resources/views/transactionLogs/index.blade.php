@extends('layouts.app')

@section('content')
<h1 class="text-center">سجل العمليات</h1>
            <a href="{{ route("transactionLogs.create", ['id' => $id]) }}" class="btn btn-primary">اضافة عمليه</a>
<div class="row">
    <div class="col-md-3 order-md-2">
        <div class="card">
    <div class="card-body">
        <h5 class="card-title">بيانات العميل</h5>
        <p class="card-text">اسم العميل: {{ $customer->name }}</p>
        <p class="card-text">البريد الإلكتروني: {{ $customer->email }}</p>
        <p class="card-text">رقم الهاتف: {{ $customer->phone }}</p>
        <p class="card-text">دولار: {{ $customer->amount_usd }}</p>
        <p class="card-text">ريال يمني: {{ $customer->amount_yr }}</p>
        <p class="card-text">ريال سعودي: {{ $customer->amount_sr }}</p>
    </div>
</div>
</div>
<div class="col-md-9 order-md-1">

            @livewire('TransactionLog',['transactionLogs' => $transactionLogs, 'id' => $id])

</div>
        @endsection
