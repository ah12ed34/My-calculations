
@extends('layouts.app')
@section('back')
<a href="{{ route('transactionLogs.index', ['id' => $id]) }}" class="btn btn-secondary">رجوع</a>
@endsection
@section('content')
<form action="{{ route('transactionLogs.update', ['transactionLog' => $transactionLog->id,'id' => $id]) }}" method="POST">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="title">عنوان</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $transactionLog->title }}">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="amount">المبلغ</label>
        <input type="number" name="amount" id="amount" class="form-control" value="{{ $transactionLog->amount }}">
        @error('amount')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="type">نوع</label>
        <select name="type" id="type" class="form-control">
            <option value="deposit" @if($transactionLog->type == 'deposit') selected @endif>ايداع</option>
            <option value="withdraw" @if($transactionLog->type == 'withdraw') selected @endif>سحب</option>
        </select>
        @error('type')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="currency">العمله</label>
        <select name="currency" id="currency" class="form-control">
            <option value="usd" @if($transactionLog->currency == 'usd') selected @endif>دولار</option>
            <option value="yr" @if($transactionLog->currency == 'yr') selected @endif>ريال يمني</option>
            <option value="sr" @if($transactionLog->currency == 'sr') selected @endif>ريال سعودي</option>
        </select>
        @error('currency')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">الوصف</label>
        <textarea name="description" id="description" class="form-control">{{ $transactionLog->description }}</textarea>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">الحاله</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" @if($transactionLog->status == 'pending') selected @endif>قيد الانتظار</option>
            <option value="cancelled" @if($transactionLog->status == 'cancelled') selected @endif>ألغيت</option>
            <option value="completed" @if($transactionLog->status == 'completed') selected @endif>مكتمل</option>
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

    <button type="submit" class="btn btn-primary">تعديل</button>
</form>
@endsection