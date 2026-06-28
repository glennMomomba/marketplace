<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Affiche la page d’édition du profil
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Met à jour les informations du profil
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        // Si l’email change, invalider la vérification
        if ($request->email !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->fill($request->only('name', 'email'));
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profil mis à jour');
    }

    /**
     * Supprime le compte utilisateur
     */
    public function destroy(Request $request)
    {
        // Validation du mot de passe avant suppression
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        return redirect('/')->with('status', 'Compte supprimé');
    }
}
