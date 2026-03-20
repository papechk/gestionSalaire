<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employer;
use App\Models\Salaire;

class AppController extends Controller
{
    public function index()
    {
        $totalDepartements = Departement::count();
        $totalEmployers = Employer::count();
        $totalSalaires = Salaire::sum('montant');
        $derniersSalaires = Salaire::with('employer')->latest()->take(5)->get();

        return view('admin.index', compact(
            'totalDepartements',
            'totalEmployers',
            'totalSalaires',
            'derniersSalaires'
        ));
    }
}
