<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Показать форму логина
    public function create()
    {
        return view('auth.login');
    }

    // Обработать логин
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required',
        ], [
            'login.required' => 'Поле "Логин" обязательно.',
            'password.required' => 'Поле "Пароль" обязательно.',
        ]);

        // Попытка логина
        if (Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->route('order')->with('success', 'Вы успешно вошли!');
        }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль.',
        ])->onlyInput('login');
    }

    // Выход
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Вы вышли из системы.');
    }
}