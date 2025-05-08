@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Modifier le rapport d'accident (Police)</h1>
            <a href="{{ route('police.signalements.show', $accident->id) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-700">
                Retour aux détails
            </a>
        </div>
        
        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Veuillez corriger les erreurs suivantes:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('police.signalements.update', $accident->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden">
            @csrf
            @method('PATCH')
            
            <!-- Basic Information Section -->
            <div class="p-6 border-b">
                <h2 class="text-lg font-medium text-gray-900 mb-3">Informations de base</h2>
                
                <!-- Type of accident -->
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type d'accident</label>
                    <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionnez un type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}" {{ $accident->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description détaillée</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ $accident->description }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">
                        Veuillez décrire le déroulement de l'accident et tout détail pertinent.
                    </p>
                </div>
                
                <!-- Accident Date and Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="accident_date" class="block text-sm font-medium text-gray-700 mb-1">Date de l'accident</label>
                        <input type="date" id="accident_date" name="accident_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $accident->accident_date }}" required>
                    </div>
                    <div>
                        <label for="accident_time" class="block text-sm font-medium text-gray-700 mb-1">Heure de l'accident</label>
                        <input type="time" id="accident_time" name="accident_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $accident->accident_time }}" required>
                    </div>
                </div>
                
                <!-- Location -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Localisation de l'accident</label>
                    <div id="map" class="w-full h-64 border border-gray-300 rounded-md mb-2"></div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="point_x" class="block text-xs font-medium text-gray-500">Latitude</label>
                            <input type="number" step="any" id="point_x" name="point_x" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" value="{{ $accident->latitude }}" required>
                        </div>
                        <div>
                            <label for="point_y" class="block text-xs font-medium text-gray-500">Longitude</label>
                            <input type="number" step="any" id="point_y" name="point_y" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" value="{{ $accident->longitude }}" required>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Cliquez sur la carte pour modifier la position exacte de l'accident.
                    </p>
                </div>
            </div>
            
            <!-- Road and Environment Conditions -->
            <div class="p-6 border-b">
                <h2 class="text-lg font-medium text-gray-900 mb-3">Conditions de route et d'environnement</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Road Type -->
                    <div>
                        <label for="road_type" class="block text-sm font-medium text-gray-700 mb-1">Type de route</label>
                        <select id="road_type" name="road_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Sélectionnez un type</option>
                            <option value="Highway" {{ $accident->road_type == 'Highway' ? 'selected' : '' }}>Autoroute</option>
                            <option value="Urban road" {{ $accident->road_type == 'Urban road' ? 'selected' : '' }}>Route urbaine</option>
                            <option value="Rural road" {{ $accident->road_type == 'Rural road' ? 'selected' : '' }}>Route rurale</option>
                        </select>
                    </div>
                    
                    <!-- Road Condition -->
                    <div>
                        <label for="road_condition" class="block text-sm font-medium text-gray-700 mb-1">État de la route</label>
                        <select id="road_condition" name="road_condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Sélectionnez un état</option>
                            <option value="Dry" {{ $accident->road_condition == 'Dry' ? 'selected' : '' }}>Sec</option>
                            <option value="Wet" {{ $accident->road_condition == 'Wet' ? 'selected' : '' }}>Mouillé</option>
                            <option value="Damaged" {{ $accident->road_condition == 'Damaged' ? 'selected' : '' }}>Endommagé</option>
                        </select>
                    </div>
                    
                    <!-- Weather Condition -->
                    <div>
                        <label for="weather_condition" class="block text-sm font-medium text-gray-700 mb-1">Conditions météorologiques</label>
                        <select id="weather_condition" name="weather_condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Sélectionnez une condition</option>
                            <option value="Sunny" {{ $accident->weather_condition == 'Sunny' ? 'selected' : '' }}>Ensoleillé</option>
                            <option value="Rainy" {{ $accident->weather_condition == 'Rainy' ? 'selected' : '' }}>Pluvieux</option>
                            <option value="Foggy" {{ $accident->weather_condition == 'Foggy' ? 'selected' : '' }}>Brumeux</option>
                        </select>
                    </div>
                    
                    <!-- Lighting -->
                    <div>
                        <label for="lighting" class="block text-sm font-medium text-gray-700 mb-1">Éclairage</label>
                        <select id="lighting" name="lighting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Sélectionnez un éclairage</option>
                            <option value="Daylight" {{ $accident->lighting == 'Daylight' ? 'selected' : '' }}>Jour</option>
                            <option value="Night" {{ $accident->lighting == 'Night' ? 'selected' : '' }}>Nuit</option>
                            <option value="Low light" {{ $accident->lighting == 'Low light' ? 'selected' : '' }}>Faible luminosité</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Additional Attachments Section -->
            <div class="p-6 border-b bg-yellow-50">
                <h2 class="text-lg font-medium text-gray-900 mb-3">Pièces jointes supplémentaires</h2>
                
                <!-- Existing Photos -->
                <div class="mb-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Photos existantes</h3>
                    @if($accident->photos && $accident->photos->count() > 0)
                        <div class="grid grid-cols-3 gap-2 mb-4">
                            @foreach($accident->photos as $photo)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $photo->path) }}" alt="Photo de l'accident" class="h-24 w-full object-cover rounded">
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 mb-4">Aucune photo disponible</p>
                    @endif
                </div>
                
                <!-- New Photos -->
                <div class="mb-4">
                    <label for="accident_photos" class="block text-sm font-medium text-gray-700 mb-1">Ajouter de nouvelles photos</label>
                    <input type="file" id="accident_photos" name="accident_photos[]" multiple class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100">
                    <p class="mt-1 text-sm text-gray-500">
                        Vous pouvez télécharger plusieurs nouvelles photos. Formats acceptés : JPG, JPEG, PNG.
                    </p>
                    <div id="accident-photo-preview" class="grid grid-cols-3 gap-2 mt-2"></div>
                </div>
                
                <!-- Additional Notes -->
                <div>
                    <label for="additional_notes" class="block text-sm font-medium text-gray-700 mb-1">Notes supplémentaires</label>
                    <textarea id="additional_notes" name="additional_notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ajoutez toute information supplémentaire pertinente concernant l'accident...">{{ $accident->additional_notes }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="px-6 py-4 bg-gray-50 text-right">
                <div class="flex justify-between">
                    <a href="{{ route('police.signalements.show', $accident->id) }}" class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md shadow-sm">
                        Annuler
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm">
                        Mettre à jour le rapport
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Map initialization
        const map = L.map('map').setView([31.7917, -7.0926], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        let marker = null;
        
        // Set marker and update coordinates on click
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            
            marker = L.marker(e.latlng).addTo(map);
            
            // Update form fields
            document.getElementById('point_x').value = e.latlng.lat;
            document.getElementById('point_y').value = e.latlng.lng;
        });
        
        // If coordinates are already set, show marker
        const lat = document.getElementById('point_x').value;
        const lng = document.getElementById('point_y').value;
        
        if (lat && lng) {
            const latlng = L.latLng(lat, lng);
            marker = L.marker(latlng).addTo(map);
            map.setView(latlng, 15);
        }
        
        // Preview for accident photos
        const accidentPhotosInput = document.getElementById('accident_photos');
        const accidentPreviewContainer = document.getElementById('accident-photo-preview');
        
        accidentPhotosInput.addEventListener('change', function() {
            accidentPreviewContainer.innerHTML = '';
            
            if (this.files) {
                Array.from(this.files).forEach(file => {
                    if (!file.type.match('image.*')) return;
                    
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'relative';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-24 w-full object-cover rounded';
                        
                        previewDiv.appendChild(img);
                        accidentPreviewContainer.appendChild(previewDiv);
                    }
                    
                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>
@endpush
@endsection