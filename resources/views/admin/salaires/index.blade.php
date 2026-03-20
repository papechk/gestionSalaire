@extends('layouts.app')
@section('title', 'Salaires')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Salaires</h2>
    <a href="{{ route('salaires.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
        + Nouveau salaire
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employé</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Département</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($salaires as $salaire)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $salaire->employer->prenom }} {{ $salaire->employer->nom }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $salaire->employer->departement->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-green-600">{{ number_format($salaire->montant, 0, ',', ' ') }} FCFA</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $salaire->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-4 text-sm text-right space-x-2">
                    <a href="{{ route('salaires.edit', $salaire) }}" class="text-blue-600 hover:underline">Modifier</a>
                    <form action="{{ route('salaires.destroy', $salaire) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce salaire ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-sm text-gray-500 text-center">Aucun salaire enregistré.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
