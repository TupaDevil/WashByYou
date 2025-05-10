<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Попытка логина
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('orders.index')->with('success', 'Вы успешно вошли!');
        }

        return back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ])->onlyInput('email');
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