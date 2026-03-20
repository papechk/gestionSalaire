@extends('layouts.app')
@section('title', 'Modifier département')

@section('content')
<div class="max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Modifier département</h2>

    <form action="{{ route('departements.update', $departement) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom du département</label>
            <input type="text" name="name" id="name" value="{{ old('name', $departement->name) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('departements.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Annuler</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
