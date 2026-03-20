<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::withCount('employers')->get();
        return view('admin.departements.index', compact('departements'));
    }

    public function create()
    {
        return view('admin.departements.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:departements']);
        Departement::create($request->only('name'));
        return redirect()->route('departements.index')->with('success', 'Département créé.');
    }

    public function edit(Departement $departement)
    {
        return view('admin.departements.edit', compact('departement'));
    }

    public function update(Request $request, Departement $departement)
    {
        $request->validate(['name' => 'required|string|max:255|unique:departements,name,' . $departement->id]);
        $departement->update($request->only('name'));
        return redirect()->route('departements.index')->with('success', 'Département modifié.');
    }

    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'Département supprimé.');
    }
}
