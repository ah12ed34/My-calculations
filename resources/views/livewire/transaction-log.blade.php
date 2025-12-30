<div>
    <!-- Add your code here  -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>المبلغ</th>
                    <th>النوع</th>
                    <th>العملة</th>
                    <th>الحالة</th>
                    <th>الملاحظة</th>
                    <th>الاستحقاق</th>
                    <th>أُنشئ</th>
                    <th>إجراءات</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>

                        <td class="text-start fw-bold">
                            {{ $log->title }}
                        </td>

                        <td class="fw-bold">
                            {{ number_format($log->amount, 2) }}
                        </td>

                        <td>
                            <span class="badge bg-{{ $log->type === 'deposit' ? 'success' : 'danger' }}">
                                {{ $log->get_arabic_type() }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $log->get_arabic_currency() }}
                            </span>
                        </td>

                        <td>
                            @php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'completed' => 'success',
                                    'cancelled' => 'secondary',
                                ];
                            @endphp

                            <span class="badge bg-{{ $statusColors[$log->status] ?? 'dark' }}">
                                {{ $log->get_arabic_status() }}
                            </span>
                        </td>

                        <td class="text-start">
                            {{ Str::limit($log->description, 30) ?: '—' }}
                        </td>

                        <td>
                            {{ $log->request_date ?? '—' }}
                        </td>

                        <td>
                            <small class="text-muted">
                                {{ $log->created_at->diffForHumans() }}
                            </small>
                        </td>

                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('transactionLogs.show', ['transactionLog' => $log->id, 'id' => $id]) }}"
                                    class="btn btn-outline-primary">
                                    عرض
                                </a>

                                <a href="{{ route('transactionLogs.edit', ['transactionLog' => $log->id, 'id' => $id]) }}"
                                    class="btn btn-outline-warning">
                                    تعديل
                                </a>

                                <form
                                    action="{{ route('transactionLogs.destroy', ['transactionLog' => $log->id, 'id' => $id]) }}"
                                    method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-muted py-4">
                            لا توجد عمليات مسجلة
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3 overflow-auto">
        {{ $logs->links() }}
    </div>

</div>
