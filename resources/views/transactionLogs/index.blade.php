@extends('layouts.app')

@section('content')
    <h1 class="text-center">سجل العمليات</h1>
    <a href="{{ route('transactionLogs.create', ['id' => $id]) }}" class="btn btn-primary">اضافة عمليه</a>
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
                    <p class="card-text">جنيه مصري: {{ $customer->amount_egp }}</p>
                    <p class="card-text">ليرة تركية: {{ $customer->amount_try }}</p>
                    <p class="card-text">العملة الافتراضية:
                    <form method="POST" action="{{ route('transactionLogs.changeCurrencyDefault', ['id' => $id]) }}">
                        @csrf
                        <select name="currency_default" id="currency_default" class="form-control"
                            onchange="this.form.submit()">
                            <option value="usd" @if ($customer->currency_default == 'usd') selected @endif>دولار</option>
                            <option value="yr" @if ($customer->currency_default == 'yr') selected @endif>ريال يمني</option>
                            <option value="sr" @if ($customer->currency_default == 'sr') selected @endif>ريال سعودي</option>
                            <option value="egp" @if ($customer->currency_default == 'egp') selected @endif>جنيه مصري</option>
                            <option value="try" @if ($customer->currency_default == 'try') selected @endif>ليرة تركية</option>
                        </select>
                    </form>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-md-9 order-md-1">

            @livewire('TransactionLog', ['transactionLogs' => $transactionLogs, 'id' => $id])

        </div>
    @endsection
