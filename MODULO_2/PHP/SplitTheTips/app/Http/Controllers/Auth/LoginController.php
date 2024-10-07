<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware para asegurar que sólo usuarios no autenticados puedan acceder a login
        $this->middleware('guest')->except('logout');
        // Middleware para asegurar que sólo usuarios autenticados puedan acceder a logout
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle a successful authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // Redirecciona al dashboard correspondiente según el rol del usuario
        if ($user->isCompany()) {
            return redirect()->route('company.dashboard');
        } elseif ($user->isEmployee()) {
            return redirect()->route('employee.dashboard');
        }

        // Registra la información del usuario en los logs
        Log::info('User logged in', ['id' => $user->id, 'role' => $user->role]);

        // Redirige a una ruta por defecto si no es ni empresa ni empleado
        return redirect('/');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email'; // O el campo que estés usando para el login
    }

    public function login(Request $request)
    {
        // Valida las credenciales de entrada
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Intenta autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Obtiene el usuario autenticado
            $user = Auth::user();
    
            // Redirecciona según el rol del usuario
            if ($user->isEmployee()) {
                return redirect()->route('employee.dashboard'); // Redirige al dashboard del empleado
            } elseif ($user->isCompany()) {
                return redirect()->route('company.dashboard'); // Redirige al dashboard de la empresa
            }
    
            // Si no es ni empresa ni empleado, redirige a una ruta por defecto
            return redirect('/'); 
        }
    
        // Si la autenticación falla, regresa con un error
        return back()->withErrors([
            'email' => 'Las credenciales son incorrectas.',
        ]);
    }
    
}
