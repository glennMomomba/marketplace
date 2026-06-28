<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Liste des rôles
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.roles.create');
    }

    // Enregistrer un rôle
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create($data);

        return redirect()->route('admin.roles.index')
                         ->with('success', 'Rôle créé avec succès.');
    }

    // Afficher un rôle
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    // Formulaire d’édition
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    // Mettre à jour un rôle
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update($data);

        return redirect()->route('admin.roles.index')
                         ->with('success', 'Rôle mis à jour.');
    }

    // Supprimer un rôle
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')
                         ->with('success', 'Rôle supprimé.');
    }
}
