<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Departement;
use App\Models\Employer;
use App\Models\Salaire;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gestionsalaire.com'],
            ['name' => 'Administrateur', 'password' => Hash::make('password')]
        );

        $departements = ['Informatique', 'Comptabilité', 'Ressources Humaines', 'Marketing', 'Logistique'];
        foreach ($departements as $name) {
            Departement::firstOrCreate(['name' => $name]);
        }

        $employees = [
            ['nom' => 'Diallo', 'prenom' => 'Mamadou', 'email' => 'mamadou.diallo@email.com', 'contact' => '77 123 45 67', 'departement' => 'Informatique', 'montant_journalier' => 15000],
            ['nom' => 'Ndiaye', 'prenom' => 'Fatou', 'email' => 'fatou.ndiaye@email.com', 'contact' => '78 234 56 78', 'departement' => 'Comptabilité', 'montant_journalier' => 12000],
            ['nom' => 'Sow', 'prenom' => 'Ibrahima', 'email' => 'ibrahima.sow@email.com', 'contact' => '76 345 67 89', 'departement' => 'Marketing', 'montant_journalier' => 10000],
            ['nom' => 'Ba', 'prenom' => 'Aminata', 'email' => 'aminata.ba@email.com', 'contact' => '77 456 78 90', 'departement' => 'Ressources Humaines', 'montant_journalier' => 13000],
            ['nom' => 'Fall', 'prenom' => 'Ousmane', 'email' => 'ousmane.fall@email.com', 'contact' => '78 567 89 01', 'departement' => 'Logistique', 'montant_journalier' => 11000],
        ];

        foreach ($employees as $data) {
            $dept = Departement::where('name', $data['departement'])->first();
            $employer = Employer::firstOrCreate(
                ['email' => $data['email']],
                [
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'contact' => $data['contact'],
                    'departement_id' => $dept->id,
                    'montant_journalier' => $data['montant_journalier'],
                ]
            );

            Salaire::firstOrCreate(
                ['employer_id' => $employer->id],
                ['montant' => $data['montant_journalier'] * 22]
            );
        }
    }
}
