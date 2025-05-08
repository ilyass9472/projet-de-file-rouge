@extends('layouts.app')

@section('content')
<div class="container px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Mes Dossiers Juridiques</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Référence</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accident</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'ouverture</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($cases as $case)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                DOSSIER-{{ str_pad($case->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($case->signalement && $case->signalement->accident)
                                    {{ $case->signalement->accident->type }} - {{ $case->signalement->accident->accident_date->format('d/m/Y') }}
                                @else
                                    Signalement #{{ $case->signalement_id }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $case->date_ouverture->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $case->status === 'open' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $case->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $case->status === 'suspended' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $case->status === 'closed' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ $case->getStatusLabel() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('lawyer.cases.show', $case->signalement_id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Voir détails
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm font-medium text-gray-500">
                                Aucun dossier assigné pour le moment
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($cases->hasPages())
            <div class="px-6 py-4 bg-white border-t border-gray-200">
                {{ $cases->links() }}
            </div>
        @endif
    </div>
</div>
@endsection