@extends('main')
@section('content')
<div class="container mt-4">
    <h2>Панель администратора</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Адрес</th>
                    <th>Дата и время</th>
                    <th>Тип услуги</th>
                    <th>Способ оплаты</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->full_name }}</td>
                    <td>{{ $order->phone_number }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->service_datetime }}</td>
                    <td>{{ $order->service_type_text }}</td>
                    <td>{{ $order->payment_type === 'cash' ? 'Наличные' : 'Карта' }}</td>
                    <td>{{ $order->status_text }}</td>
                    <td>
                        <form action="{{ route('order.update-status', $order) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>Новый</option>
                                <option value="in_progress" {{ $order->status === 'in_progress' ? 'selected' : '' }}>В работе</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Выполнен</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Отменен</option>
                            </select>
                        </form>
                        
                        @if($order->status === 'cancelled')
                            <div class="mt-1">
                                <small class="text-danger">Причина: {{ $order->cancel_reason }}</small>
                            </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelects = document.querySelectorAll('select[name="status"]');
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            if (this.value === 'cancelled') {
                const reason = prompt('Укажите причину отмены:');
                if (reason === null) {
                    this.value = this.dataset.originalValue;
                    return;
                }
                const cancelReasonInput = document.createElement('input');
                cancelReasonInput.type = 'hidden';
                cancelReasonInput.name = 'cancel_reason';
                cancelReasonInput.value = reason;
                this.form.appendChild(cancelReasonInput);
            }
            this.dataset.originalValue = this.value;
        });
    });
});
</script>
@endsection 