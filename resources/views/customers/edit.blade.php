@extends('layouts.app')

@section('back')
<a href="{{ route('customers.index') }}" class="btn btn-secondary">رجوع</a>
@endsection

@section('content')
<form action="{{ route('customers.update', $customer->id ) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">اسم العميل</label>
        <input type="text" name="name" id="name" value="{{ $customer->name }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">البريد الإلكتروني</label>
        <input type="email" name="email" id="email" value="{{ $customer->email }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="phone">رقم الهاتف</label>
        <input type="text" name="phone" id="phone" value="{{ $customer->phone }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">كلمة المرور</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="description">الوصف</label>
        <textarea name="description" id="description" class="form-control">{{ $customer->description }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
</form>
@endsection