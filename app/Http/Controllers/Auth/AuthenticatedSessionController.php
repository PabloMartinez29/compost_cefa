<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            // Obtener el usuario autenticado
            $user = Auth::user();
            
            if (!$user) {
                // Si no hay usuario autenticado, redirigir al login
                return redirect()->route('login')->with('error', 'Error de autenticación.');
            }

            // Verificar y asignar rol por defecto si es necesario
            if (is_null($user->role)) {
                \App\Models\User::where('id', $user->id)->update(['role' => 'aprendiz']);
                // Obtener el usuario actualizado
                $user = Auth::user();
            }

            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } else {
                return redirect()->route('aprendiz.dashboard');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('login')->with('error', 'Estas credenciales no coinciden con nuestros registros.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
