@extends('layouts.app')
@section('title', 'Nouveau salaire')

@section('content')
<div class="max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Nouveau salaire</h2>

    <form action="{{ route('salaires.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-4">
        @csrf
        <div>
            <label for="employer_id" class="block text-sm font-medium text-gray-700 mb-1">Employé</label>
            <select name="employer_id" id="employer_id"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" required>
                <option value="">-- Sélectionner --</option>
                @foreach($employers as $emp)
                    <option value="{{ $emp->id }}" data-montant="{{ $emp->montant_journalier }}"
                            {{ old('employer_id') == $emp->id ? 'selected' : '' }}>
                        {{ $emp->prenom }} {{ $emp->nom }} ({{ $emp->departement->name ?? '—' }})
                    </option>
                @endforeach
            </select>
            @error('employer_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="montant" class="block text-sm font-medium text-gray-700 mb-1">Montant (FCFA)</label>
            <input type="number" name="montant" id="montant" value="{{ old('montant') }}" min="0"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" required>
            @error('montant') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            <p class="text-xs text-gray-400 mt-1">Montant journalier de l'employé : <span id="montant-info">—</span></p>
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('salaires.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Annuler</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">Enregistrer</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('employer_id').addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        const m = opt.dataset.montant;
        document.getElementById('montant-info').textContent = m ? Number(m).toLocaleString('fr-FR') + ' FCFA' : '—';
    });
</script>
@endsection
