<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;




class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'full_name' => 'required|string|regex:/^[а-яА-ЯёЁ\s]+$/u|max:255',
            'phone_number' => 'required|string|regex:/^\+7\(?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/',
            'email' => 'required|email|unique:users,email|max:255',
        ], [
            'login.required' => 'Поле "Логин" обязательно.',
            'password.required' => 'Поле "Пароль" обязательно.',
            'password.min' => 'Пароль должен содержать минимум 6 символов.',
            'full_name.required' => 'Поле "ФИО" обязательно.',
            'full_name.regex' => 'ФИО должно содержать только кириллицу и пробелы.',
            'phone_number.required' => 'Поле "Телефон" обязательно.',
            'phone_number.regex' => 'Телефон должен быть в формате +7XXXXXXXXXX.',
            'email.required' => 'Поле "Email" обязательно.',
            'email.email' => 'Введите корректный email.',
            'email.unique' => 'Этот email уже зарегистрирован.',
        ]);

        $user = User::create([
            'login' => $validated['login'],
            'password' => Hash::make($validated['password']), // Используем Hash вместо bcrypt
            'full_name' => $validated['full_name'],
            'phone_number' => preg_replace('/[()-]/', '', $validated['phone_number']),
            'email' => $validated['email'],
        ]);

        Auth::login($user);
        return redirect()->intended('/order');

    }
    
    

}
