<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Afficher le profil du client
     */
    public function edit()
    {
        $user = Auth::user();

        return view('client.profile.edit', compact('user'));
    }

    /**
     * Mettre à jour les informations du profil du client
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        // Mise à jour des champs validés
        $user->fill($request->validated());

        // Gestion de l’avatar (upload image)
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Si l’email change → réinitialiser la vérification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('client.profile.edit')
                       ->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Supprimer le compte client
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')
                       ->with('success', 'Votre compte a été supprimé.');
    }
}
