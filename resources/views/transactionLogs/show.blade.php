@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Transaction Log Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Title: {{ $transactionLog->title }}</h5>
                <p class="card-text">Amount: {{ $transactionLog->amount }}</p>
                <p class="card-text">Type: {{ $transactionLog->get_arabic_type() }}</p>
                <p class="card-text">Currency: {{ $transactionLog->get_arabic_currency() }}</p>
                <p class="card-text">Status: {{ $transactionLog->get_arabic_status() }}</p>
                <p class="card-text">Description: {{ $transactionLog->description }}</p>
                <p class="card-text">Request Date: {{ $transactionLog->request_date }}</p>
                <p class="card-text">Created At: {{ $transactionLog->created_at->toDayDateTimeString() }}</p>
                <p class="card-text">Updated At: {{ $transactionLog->updated_at->toDayDateTimeString() }}</p>
                {{-- <a href="{{ route('transactionLogs.index', ['id' => $customer_Id]) }}" class="btn btn-secondary">Back to Transaction Logs</a> --}}
            </div>
        </div>
    </div>
@endsection
