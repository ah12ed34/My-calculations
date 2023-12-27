@extends('layouts.app')
@section('back')
<a href="{{ route('customers.index') }}" class="btn btn-secondary">رجوع</a>
@endsection
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
            
            <!-- Add your code here -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>المبلغ</th>
                        <th>نوع العملية</th>
                        <th>العمله</th>
                        <th>الحاله</th>
                        <th>الملاحضة</th>
                        <th>الاستحقاق</th>
                        <th>التعديل</th>
                        <th>انشاء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactionLogs as $TransactionLog)
                        <tr>
                            <td>{{ $TransactionLog->id }}</td>
                            <td>{{ $TransactionLog->title }}</td>
                            <td>{{ $TransactionLog->amount }}</td>
                            <td>{{ $TransactionLog->get_arabic_type()}}</td>
                            <td>{{ $TransactionLog->get_arabic_currency() }}</td>
                            <td>{{ $TransactionLog->get_arabic_status() }}</td>
                            <td>{{ Str::limit( $TransactionLog->description, 20) }}</td>
                            <td>{{ $TransactionLog->request_date }}</td>
                            <td>{{ $TransactionLog->updated_at->diffForHumans() }}</td>
                            <td>{{ $TransactionLog->created_at->diffForHumans() }}</td>
                            <td><a href="{{ route('transactionLogs.edit', ['transactionLog' => $TransactionLog->id ,'id' => $id]) }}" class="btn btn-primary">تعديل</a></td>
                            <td><a href="{{ route('transactionLogs.destroy', ['transactionLog' => $TransactionLog->id ,'id' => $id]) }}" class="btn btn-danger">حذف</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

</div>
        @endsection
