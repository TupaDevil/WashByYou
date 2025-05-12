<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function show()
    {
        if (Auth::user()->login === 'adminka') {
            $orders = Order::with('user')->latest()->get();
            return view('order.admin', compact('orders'));
        }

        $orders = Auth::user()->orders()->latest()->get();
        return view('order.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if (Auth::user()->login !== 'adminka') {
            return redirect()->back()->with('error', 'У вас нет прав для этого действия');
        }

        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,completed,cancelled',
            'cancel_reason' => 'required_if:status,cancelled|nullable|string|max:255'
        ]);

        $order->update($validated);

        return redirect()->back()->with('success', 'Статус заказа обновлен');
    }
}
