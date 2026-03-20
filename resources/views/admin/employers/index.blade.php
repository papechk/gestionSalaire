@extends('layouts.app')
@section('title', 'Employés')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Employés</h2>
    <a href="{{ route('employers.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
        + Nouvel employé
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom complet</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Département</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant/jour</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($employers as $emp)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $emp->prenom }} {{ $emp->nom }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $emp->email }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $emp->contact }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $emp->departement->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ number_format($emp->montant_journalier, 0, ',', ' ') }} FCFA</td>
                <td class="px-6 py-4 text-sm text-right space-x-2">
                    <a href="{{ route('employers.edit', $emp) }}" class="text-blue-600 hover:underline">Modifier</a>
                    <form action="{{ route('employers.destroy', $emp) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet employé ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-sm text-gray-500 text-center">Aucun employé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
