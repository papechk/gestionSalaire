@extends('layouts.app')
@section('title', 'Modifier salaire')

@section('content')
<div class="max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Modifier salaire</h2>

    <form action="{{ route('salaires.update', $salaire) }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label for="employer_id" class="block text-sm font-medium text-gray-700 mb-1">Employé</label>
            <select name="employer_id" id="employer_id"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" required>
                @foreach($employers as $emp)
                    <option value="{{ $emp->id }}" {{ old('employer_id', $salaire->employer_id) == $emp->id ? 'selected' : '' }}>
                        {{ $emp->prenom }} {{ $emp->nom }} ({{ $emp->departement->name ?? '—' }})
                    </option>
                @endforeach
            </select>
            @error('employer_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="montant" class="block text-sm font-medium text-gray-700 mb-1">Montant (FCFA)</label>
            <input type="number" name="montant" id="montant" value="{{ old('montant', $salaire->montant) }}" min="0"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" required>
            @error('montant') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('salaires.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Annuler</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
