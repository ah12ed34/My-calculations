
@extends('layouts.app')
@section('back')
<a href="{{ route('transactionLogs.index', ['id' => $id]) }}" class="btn btn-secondary">Back</a>
@endsection
@section('content')
<form action="{{ route('transactionLogs.update', ['transactionLog' => $transactionLog->id,'id' => $id]) }}" method="POST">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $transactionLog->title }}">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" name="amount" id="amount" class="form-control" value="{{ $transactionLog->amount }}">
        @error('amount')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control">
            <option value="deposit" @if($transactionLog->type == 'deposit') selected @endif>Deposit</option>
            <option value="withdraw" @if($transactionLog->type == 'withdraw') selected @endif>Withdraw</option>
        </select>
        @error('type')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="currency">Currency</label>
        <select name="currency" id="currency" class="form-control">
            <option value="usd" @if($transactionLog->currency == 'usd') selected @endif>USD</option>
            <option value="yr" @if($transactionLog->currency == 'yr') selected @endif>YR</option>
            <option value="sr" @if($transactionLog->currency == 'sr') selected @endif>SR</option>
        </select>
        @error('currency')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $transactionLog->description }}</textarea>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" @if($transactionLog->status == 'pending') selected @endif>Pending</option>
            <option value="cancelled" @if($transactionLog->status == 'cancelled') selected @endif>Cancelled</option>
            <option value="completed" @if($transactionLog->status == 'completed') selected @endif>Completed</option>
        </select>
        @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="request_date">Request Date</label>
        <input type="date" name="request_date" id="request_date" class="form-control" value="{{ $transactionLog->request_date }}">
        @error('request_date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection