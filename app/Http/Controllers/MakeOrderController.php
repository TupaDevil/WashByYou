<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MakeOrderController extends Controller
{
    public function create(){
        return view('order.makeOrder');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'service_date' => 'required|date',
            'service_time' => 'required',
            'service_type' => 'required|in:general_cleaning,deep_cleaning,post_construction_cleaning,carpet_furniture_cleaning',
            'payment_type' => 'required|in:cash,card',
        ], [
            'full_name.required' => 'Поле "ФИО" обязательно.',
            'phone_number.required' => 'Поле "Телефон" обязательно.',
            'email.required' => 'Поле "Email" обязательно.',
            'email.email' => 'Введите корректный email.',
            'address.required' => 'Поле "Адрес" обязательно.',
            'service_date.required' => 'Поле "Дата" обязательно.',
            'service_time.required' => 'Поле "Время" обязательно.',
            'service_type.required' => 'Выберите вид услуги.',
            'payment_type.required' => 'Выберите тип оплаты.',
        ]);

            // Объединяем дату и время
            $serviceDateTime = Carbon::createFromFormat('Y-m-d H:i', $validated['service_date'] . ' ' . $validated['service_time'])->format('Y-m-d H:i:s');

            // Создаём запись с привязкой к пользователю
            $order = Auth::user()->orders()->create([
                'full_name' => $validated['full_name'],
                'phone_number' => $validated['phone_number'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'service_datetime' => $serviceDateTime,
                'service_type' => $validated['service_type'],
                'payment_type' => $validated['payment_type'],
            ]);
            
            return redirect()->route('order')->with('success', 'Заказ успешно создан!');
        }
    }