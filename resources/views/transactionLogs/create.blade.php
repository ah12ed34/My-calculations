@extends('layouts.app')

@section('back')
<a href="{{ route('transactionLogs.index', ['id' => $id]) }}" class="btn btn-secondary">Back</a>
@endsection


@section('content')
    <div class="container">        
        <h1 class="text-center">Add Transaction Log</h1>
        <form action="{{ route('transactionLogs.store', ['id' => $id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" class="form-control">
                @error('amount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select name="type" id="type" class="form-control">
                    <option value="deposit">Deposit</option>
                    <option value="withdraw">Withdraw</option>
                </select>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="currency">Currency:</label>
                <select name="currency" id="currency" class="form-control">
                    <option value="usd">دولار</option>
                    <option value="yr">ريال يمني</option>
                    <option value="sr">ريال سعودي</option>
                </select>
                @error('currency')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending">pending</option>
                    <option value="completed">completed</option>
                    <option value="cancelled">cancelled</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="request_date">Request Date:</label>
                <input type="date" name="request_date" id="request_date" class="form-control" value="{{ date('Y-m-d') }}">
                @error('request_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection
