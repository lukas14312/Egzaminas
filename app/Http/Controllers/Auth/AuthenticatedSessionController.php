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
        return view('auth.login');  // Tai rodys login puslapį
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Jei prisijungimas sėkmingas, 'authenticate' bus atliktas pagal LoginRequest validaciją
        $request->authenticate();

        // Jei prisijungimas sėkmingas, regeneruojame sesiją
        $request->session()->regenerate();

        // Patikriname, ar vartotojas patvirtino savo el. paštą
        if (auth()->user()->hasVerifiedEmail()) {
            // Jei taip, nukreipiame į prekių puslapį
            return redirect()->intended(route('prekes.index'));
        }

        // Jei el. paštas nepatvirtintas, grąžiname į prisijungimo puslapį
        return redirect()->route('login')->with('error', 'Please verify your email address.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Išjungiame vartotoją
        Auth::guard('web')->logout();

        // Invaliduojame sesiją ir regeneruojame tokeną
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Nukreipiame į prisijungimo puslapį
        return redirect()->route('login');
    }
}
