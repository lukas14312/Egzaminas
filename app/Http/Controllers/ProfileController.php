<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Rodo vartotojo profilio redagavimo formą
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Atnaujina vartotojo profilio informaciją
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email,' . $request->user()->id],
        ]);

        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('status', 'Profilis sėkmingai atnaujintas!');
    }

    /**
     * Keičia vartotojo slaptažodį
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        // Patikriname, ar vartotojas yra prisijungęs
        if (!$user) {
            return redirect()->route('login')->withErrors('Jūs turite būti prisijungęs.');
        }

        // Validacija: tikriname esamą ir naują slaptažodį
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // Tikriname, ar senas slaptažodis teisingas
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Senas slaptažodis neteisingas.']);
        }

        // Atnaujiname slaptažodį
        $user->password = Hash::make($request->password); 
        $user->save();

        // Atsijungiame ir išvalome sesiją
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Nukreipiame į prisijungimo puslapį su pranešimu
        return redirect()->route('login')->with('status', 'Slaptažodis sėkmingai pakeistas! Prisijunkite iš naujo.');
    }

    /**
     * Ištrina vartotojo paskyrą
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Tikriname, ar slaptažodis teisingas
        if (Hash::check($request->password, $user->password)) {
            // Ištriname paskyrą
            $user->delete();

            // Nukreipiame į prisijungimo puslapį
            return redirect()->route('login')->with('status', 'Paskyra sėkmingai ištrinta.');
        }

        // Jei slaptažodis neteisingas
        return back()->withErrors(['password' => 'Neteisingas slaptažodis.']);
    }
}
