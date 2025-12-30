@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
                        <span>تفاصيل العملية</span>

                        <span class="badge bg-{{ $transactionLog->type === 'deposit' ? 'success' : 'danger' }}">
                            {{ $transactionLog->get_arabic_type() }}
                        </span>
                    </div>

                    <div class="card-body">

                        <div class="mb-3 text-center">
                            <h4 class="fw-bold">
                                {{ number_format($transactionLog->amount, 2) }}
                                <small class="text-muted">
                                    {{ $transactionLog->get_arabic_currency() }}
                                </small>
                            </h4>

                            <span
                                class="badge bg-{{ $transactionLog->status === 'completed'
                                    ? 'success'
                                    : ($transactionLog->status === 'pending'
                                        ? 'warning'
                                        : 'secondary') }}">
                                {{ $transactionLog->get_arabic_status() }}
                            </span>
                        </div>

                        <hr>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>العنوان:</strong>
                                <span class="float-end">{{ $transactionLog->title }}</span>
                            </li>

                            <li class="list-group-item">
                                <strong>الوصف:</strong>
                                <span class="float-end">
                                    {{ $transactionLog->description ?: '—' }}
                                </span>
                            </li>

                            <li class="list-group-item">
                                <strong>تاريخ الاستحقاق:</strong>
                                <span class="float-end">
                                    {{ $transactionLog->request_date ?? '—' }}
                                </span>
                            </li>

                            <li class="list-group-item">
                                <strong>تاريخ الإنشاء:</strong>
                                <span class="float-end">
                                    {{ $transactionLog->created_at->toDayDateTimeString() }}
                                </span>
                            </li>

                            <li class="list-group-item">
                                <strong>آخر تعديل:</strong>
                                <span class="float-end">
                                    {{ $transactionLog->updated_at->toDayDateTimeString() }}
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ route('transactionLogs.index', ['id' => $transactionLog->customer_id]) }}"
                            class="btn btn-outline-secondary btn-sm">
                            رجوع إلى السجل
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('title', 'تفاصيل العملية')
