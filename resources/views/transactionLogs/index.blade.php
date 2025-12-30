@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">سجل العمليات</h3>
            <form method="POST" action="{{ route('transactionLogs.recalculate', ['id' => $id]) }}"
                onsubmit="return confirm('سيتم إعادة حساب جميع العمليات. هل أنت متأكد؟')">
                @csrf

                <button class="btn btn-warning btn-sm">
                    إصلاح العمليات وإعادة الحساب
                </button>
            </form>
            <a href="{{ route('transactionLogs.create', ['id' => $id]) }}" class="btn btn-success">
                إضافة عملية
            </a>
        </div>

        <div class="row">
            {{-- <div class="col-md-3 order-md-2">
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
                    <form method="POST" action="{{ route('transactionLogs.changeCurrencyDefault', ['id' => $id]) }}">
                        @csrf
                        <label for="currency_default">العملة الافتراضية:</label>
                        <select name="currency_default" id="currency_default" class="form-control"
                            onchange="this.form.submit()">
                            <option value="usd" @if ($customer->currency_default == 'usd') selected @endif>دولار</option>
                            <option value="yr" @if ($customer->currency_default == 'yr') selected @endif>ريال يمني</option>
                            <option value="sr" @if ($customer->currency_default == 'sr') selected @endif>ريال سعودي</option>
                            <option value="egp" @if ($customer->currency_default == 'egp') selected @endif>جنيه مصري</option>
                            <option value="try" @if ($customer->currency_default == 'try') selected @endif>ليرة تركية</option>
                        </select>
                    </form>

                </div>
            </div>
        </div> --}}
            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light fw-bold">
                        بيانات العميل
                    </div>

                    <div class="card-body p-3">
                        <div class="mb-2"><strong>الاسم:</strong> {{ $customer->name }}</div>
                        <div class="mb-2"><strong>البريد:</strong> {{ $customer->email }}</div>
                        <div class="mb-3"><strong>الهاتف:</strong> {{ $customer->phone }}</div>

                        <hr>

                        <h6 class="fw-bold mb-2">الأرصدة</h6>

                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>USD</span><span>{{ number_format($customer->amount_usd, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>YER</span><span>{{ number_format($customer->amount_yr, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>SAR</span><span>{{ number_format($customer->amount_sr, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>EGP</span><span>{{ number_format($customer->amount_egp, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>TRY</span><span>{{ number_format($customer->amount_try, 2) }}</span>
                            </li>
                        </ul>

                        <form method="POST" action="{{ route('transactionLogs.changeCurrencyDefault', ['id' => $id]) }}">
                            @csrf
                            <label class="form-label fw-bold">العملة الافتراضية</label>
                            <select name="currency_default" class="form-select" onchange="this.form.submit()">
                                @foreach (['usd' => 'USD', 'yr' => 'YER', 'sr' => 'SAR', 'egp' => 'EGP', 'try' => 'TRY'] as $key => $label)
                                    <option value="{{ $key }}" @selected($customer->currency_default === $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-header bg-light fw-bold">
                        العمليات
                    </div>
                    <div class="card-body">
                        @livewire('TransactionLog', ['transactionLogs' => $transactionLogs, 'id' => $id])
                    </div>
                </div>
            </div>
        @endsection
