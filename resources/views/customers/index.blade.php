@extends('layouts.app')

@section('content')
    <h1>Create Customer</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">انشاء عميل جديد</a>
    <!-- Add your code here -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>الايميل</th>
                <th>رقم الهاتف</th>
                <th colspan="5">حساب </th>
                <th>الملاحضة</th>
                <th>التعديل</th>
                <th>انشاء</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->amount_usd }}&nbsp;$</td>
                    <td>{{ $customer->amount_yr }}&nbsp;ر.ي</td>
                    <td>{{ $customer->amount_sr }}&nbsp;ر.س</td>
                    <td>{{ $customer->amount_egp }}&nbsp;ج.م</td>
                    <td>{{ $customer->amount_try }}&nbsp;ل.ت</td>
                    <td>{{ Str::limit($customer->description, 20) }}</td>
                    <td>{{ $customer->updated_at->diffForHumans() }}</td>
                    <td>{{ $customer->created_at->diffForHumans() }}</td>
                    <td><a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">تعديل</a></td>
                    <td><a href="{{ url('customers/' . $customer->id . '/transactionLogs') }}"
                            class="btn btn-primary">عرض</a>
                    </td>
                </tr>
            @endforeach
    </table>
@endsection
