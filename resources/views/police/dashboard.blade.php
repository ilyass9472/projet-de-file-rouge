@extends('layouts.app')
@section('content')
<div class="flex">
    @include('components.police.sidebar-new')
    <div class="flex-1 ml-0 lg:ml-64 min-h-screen">
        <div class="container mx-auto px-4 py-6">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Tableau de Bord Police</h1>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-50 rounded-lg p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 text-white mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-blue-600">Signalements total</p>
                                <h3 class="text-2xl font-bold text-gray-800">{{ $totalSignalements }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 rounded-lg p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 text-white mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-yellow-600">En attente</p>
                                <h3 class="text-2xl font-bold text-gray-800">{{ $pendingSignalements }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 rounded-lg p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 text-white mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-green-600">Traités</p>
                                <h3 class="text-2xl font-bold text-gray-800">{{ $processedSignalements }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <a href="{{ route('police.signalements.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Créer un nouveau rapport d'accident
                    </a>
                    
                    <a href="{{ route('police.accidents') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Voir tous les accidents
                    </a>
                </div>
                <div class="bg-white p-4 rounded shadow my-6">
                    <h2 class="text-lg font-bold mb-4">Cartographie des Accidents</h2>
                    <div id="accidentMap" style="height: 400px; width: 100%; border-radius: 8px;"></div>
                    <div class="flex justify-center mt-3 space-x-4">
                        <div class="flex items-center">
                            <span class="inline-block w-4 h-4 bg-red-500 rounded-full mr-2"></span>
                            <span>Accidents</span>
                        </div>
                        <div class="flex items-center">
                            <span class="inline-block w-4 h-4 bg-blue-500 rounded-full mr-2"></span>
                            <span>Signalements</span>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">Signalements Récents</h2>
                        <a href="{{ route('police.signalements.index') }}" class="text-blue-600 hover:text-blue-800">Voir tous</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($recentSignalements as $signalement)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">{{ $signalement->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">{{ $signalement->type }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ Str::limit($signalement->description, 50) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $signalement->statut == 'en_attente' ? 'bg-yellow-100 text-yellow-800' : 
                                            ($signalement->statut == 'en_cours' ? 'bg-blue-100 text-blue-800' : 
                                            ($signalement->statut == 'traite' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                            {{ $signalement->statut }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $signalement->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('police.signalements.show', $signalement->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 hover:bg-indigo-200 rounded-full p-2" title="Voir">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('police.signalements.edit', $signalement->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 rounded-full p-2" title="Modifier">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                @if(count($recentSignalements) === 0)
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Aucun signalement récent</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
        crossorigin=""></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
      crossorigin=""/>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('accidentMap').setView([31.7917, -7.0926], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var accidents = @json($accidents);
        var signalements = @json($signalements);
        accidents.forEach(function(accident) {
            if (accident.latitude && accident.longitude) {
                var marker = L.marker([accident.latitude, accident.longitude], {
                    icon: L.divIcon({
                        className: 'custom-div-icon',
                        html: `<div style="background-color: rgba(220, 38, 38, 0.8); width: 12px; height: 12px; border-radius: 50%; border: 2px solid white;"></div>`,
                        iconSize: [12, 12],
                        iconAnchor: [6, 6]
                    })
                }).addTo(map);
                
                marker.bindPopup(`
                    <strong>Accident #${accident.id}</strong><br>
                    Type: ${accident.type || 'Non spécifié'}<br>
                    Date: ${accident.accident_date || 'Non spécifiée'}<br>
                    Type de route: ${accident.road_type || 'Non spécifié'}<br>
                    <a href="/police/signalements/${accident.id}" class="text-blue-600 hover:underline">Voir détails</a>
                `);
            }
        });
        signalements.forEach(function(signalement) {
            if (signalement.point && signalement.point.x && signalement.point.y) {
                var marker = L.marker([signalement.point.x, signalement.point.y], {
                    icon: L.divIcon({
                        className: 'custom-div-icon',
                        html: `<div style="background-color: rgba(59, 130, 246, 0.8); width: 12px; height: 12px; border-radius: 50%; border: 2px solid white;"></div>`,
                        iconSize: [12, 12],
                        iconAnchor: [6, 6]
                    })
                }).addTo(map);
                
                marker.bindPopup(`
                    <strong>Signalement #${signalement.id}</strong><br>
                    Type: ${signalement.type || 'Non spécifié'}<br>
                    Statut: ${signalement.statut || 'Non spécifié'}<br>
                    <a href="/police/signalements/${signalement.id}" class="text-blue-600 hover:underline">Voir détails</a>
                `);
            }
        });
    });
</script>

<style>
.custom-div-icon {
    position: relative;
}

.custom-div-icon div {
    position: absolute;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    top: -11px;
    left: -11px;
    box-shadow: 0 0 0 2px white, 0 0 10px rgba(0, 0, 0, 0.35);
    transition: all 0.3s ease;
}

.custom-div-icon div:hover {
    transform: scale(1.2);
}
</style>
@endpush
@endsection