@extends('layouts.app')
@section('title', 'Départements')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Départements</h2>
    <a href="{{ route('departements.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
        + Nouveau département
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employés</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($departements as $dept)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $dept->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $dept->employers_count }}</td>
                <td class="px-6 py-4 text-sm text-right space-x-2">
                    <a href="{{ route('departements.edit', $dept) }}" class="text-blue-600 hover:underline">Modifier</a>
                    <form action="{{ route('departements.destroy', $dept) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce département ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-sm text-gray-500 text-center">Aucun département.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
