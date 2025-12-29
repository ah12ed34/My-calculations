<div>
    <!-- Add your code here  -->
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
            @foreach ($logs as $TransactionLog)
                <tr>
                    <td>{{ $TransactionLog->id }}</td>
                    <td>{{ $TransactionLog->title }}</td>
                    <td>{{ $TransactionLog->amount }}</td>
                    <td>{{ $TransactionLog->get_arabic_type() }}</td>
                    <td>{{ $TransactionLog->get_arabic_currency() }}</td>
                    <td>{{ $TransactionLog->get_arabic_status() }}</td>
                    <td>{{ Str::limit($TransactionLog->description, 20) }}</td>
                    <td>{{ $TransactionLog->request_date }}</td>
                    <td>{{ $TransactionLog->updated_at->diffForHumans() }}</td>
                    <td>{{ $TransactionLog->created_at->diffForHumans() }}</td>
                    <td><a href="{{ route('transactionLogs.edit', ['transactionLog' => $TransactionLog->id, 'id' => $id]) }}"
                            class="btn btn-primary">تعديل</a></td>

                    {{-- <td><a href="{{ route('transactionLogs.destroy', ['transactionLog' => $TransactionLog->id ,'id' => $id]) }}" class="btn btn-danger">حذف</a></td> --}}
                    <td>
                        <form
                            action="{{ route('transactionLogs.destroy', ['transactionLog' => $TransactionLog->id, 'id' => $id]) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $logs->links() }}
    </div>
</div>
