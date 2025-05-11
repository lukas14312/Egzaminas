<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        // Validacija
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required'], // Tik patikrinimas, ar dabartinis slaptažodis yra užpildytas
            'password' => ['required', 'confirmed'], // Tiesiog tikriname, ar slaptažodis ir jo patvirtinimas sutampa
        ]);

        // Patikriname, ar dabartinis slaptažodis teisingas
        if (!Hash::check($validated['current_password'], $request->user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Slaptažodžio atnaujinimas
        $request->user()->update([
            'password' => Hash::make($validated['password']),  // Užšifruojame naują slaptažodį
        ]);

        // Sėkmės pranešimas
        return back()->with('status', 'Password updated successfully!');
    }
}
