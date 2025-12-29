@extends('layouts.app')

@section('back')
    <a href="{{ route('transactionLogs.index', ['id' => $id]) }}" class="btn btn-secondary">رجوع</a>
@endsection


@section('content')
    <div class="container">
        <h1 class="text-center">Add Transaction Log</h1>
        <form action="{{ route('transactionLogs.store', ['id' => $id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">عنوان:</label>
                <input type="text" name="title" id="title" class="form-control">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="amount">المبلغ:</label>
                <input type="number" name="amount" id="amount" class="form-control">
                @error('amount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">نوع:</label>
                <select name="type" id="type" class="form-control">
                    <option value="deposit">ايداع</option>
                    <option value="withdraw">سحب</option>
                </select>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="currency">العمله:</label>
                <select name="currency" id="currency" class="form-control">
                    <option value="usd" @if ($currency_default == 'usd') selected @endif>دولار</option>
                    <option value="yr" @if ($currency_default == 'yr') selected @endif>ريال يمني</option>
                    <option value="sr" @if ($currency_default == 'sr') selected @endif>ريال سعودي</option>
                    <option value="egp" @if ($currency_default == 'egp') selected @endif>جنيه مصري</option>
                    <option value="try" @if ($currency_default == 'try') selected @endif>ليرة تركية</option>
                </select>
                @error('currency')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">الحاله:</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending">قيد الانتظار</option>
                    <option value="completed">مكتمل</option>
                    <option value="cancelled">ألغيت</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">الوصف:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="request_date">Request Date:</label>
                <input type="date" name="request_date" id="request_date" class="form-control"
                    value="{{ date('Y-m-d') }}">
                @error('request_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">اضافة</button>
        </form>
    </div>
@endsection
