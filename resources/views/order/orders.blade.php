@extends('main')
@section('content')
<div class="container mt-4">
    <h2>Мои заказы</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Адрес</th>
                    <th>Дата и время</th>
                    <th>Тип услуги</th>
                    <th>Способ оплаты</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->service_datetime }}</td>
                    <td>{{ $order->service_type_text }}</td>
                    <td>{{ $order->payment_type === 'cash' ? 'Наличные' : 'Карта' }}</td>
                    <td>
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : ($order->status === 'in_progress' ? 'primary' : 'secondary')) }}">
                            {{ $order->status_text }}
                        </span>
                        @if($order->status === 'cancelled' && $order->cancel_reason)
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
@endsection
