<?php

namespace App\Http\Controllers;

use App\Models\Salaire;
use App\Models\Employer;
use Illuminate\Http\Request;

class SalaireController extends Controller
{
    public function index()
    {
        $salaires = Salaire::with('employer.departement')->latest()->get();
        return view('admin.salaires.index', compact('salaires'));
    }

    public function create()
    {
        $employers = Employer::with('departement')->get();
        return view('admin.salaires.create', compact('employers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'montant' => 'required|numeric|min:0',
        ]);
        Salaire::create($request->only('employer_id', 'montant'));
        return redirect()->route('salaires.index')->with('success', 'Salaire enregistré.');
    }

    public function edit(Salaire $salaire)
    {
        $employers = Employer::with('departement')->get();
        return view('admin.salaires.edit', compact('salaire', 'employers'));
    }

    public function update(Request $request, Salaire $salaire)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'montant' => 'required|numeric|min:0',
        ]);
        $salaire->update($request->only('employer_id', 'montant'));
        return redirect()->route('salaires.index')->with('success', 'Salaire modifié.');
    }

    public function destroy(Salaire $salaire)
    {
        $salaire->delete();
        return redirect()->route('salaires.index')->with('success', 'Salaire supprimé.');
    }
}
