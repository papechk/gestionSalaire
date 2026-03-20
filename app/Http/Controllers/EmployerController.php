<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Departement;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::with('departement')->get();
        return view('admin.employers.index', compact('employers'));
    }

    public function create()
    {
        $departements = Departement::all();
        return view('admin.employers.create', compact('departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:50',
            'departement_id' => 'required|exists:departements,id',
            'montant_journalier' => 'required|numeric|min:0',
        ]);
        Employer::create($request->only('nom', 'prenom', 'email', 'contact', 'departement_id', 'montant_journalier'));
        return redirect()->route('employers.index')->with('success', 'Employé ajouté.');
    }

    public function edit(Employer $employer)
    {
        $departements = Departement::all();
        return view('admin.employers.edit', compact('employer', 'departements'));
    }

    public function update(Request $request, Employer $employer)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:50',
            'departement_id' => 'required|exists:departements,id',
            'montant_journalier' => 'required|numeric|min:0',
        ]);
        $employer->update($request->only('nom', 'prenom', 'email', 'contact', 'departement_id', 'montant_journalier'));
        return redirect()->route('employers.index')->with('success', 'Employé modifié.');
    }

    public function destroy(Employer $employer)
    {
        $employer->delete();
        return redirect()->route('employers.index')->with('success', 'Employé supprimé.');
    }
}
