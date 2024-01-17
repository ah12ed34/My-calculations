<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
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
            @foreach($transactionLogs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->title }}</td>
                    <td>{{ $log->amount }}</td>
                    <td>{{ $log->get_arabic_type()}}</td>
                    <td>{{ $log->get_arabic_currency() }}</td>
                    <td>{{ $log->get_arabic_status() }}</td>
                    <td>{{ Str::limit( $log->description, 20) }}</td>
                    <td>{{ $log->request_date }}</td>
                    <td>{{ $log->updated_at->diffForHumans() }}</td>
                    <td>{{ $log->created_at->diffForHumans() }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $transactionLogs->links() }}
</div>
