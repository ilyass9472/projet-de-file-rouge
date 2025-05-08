@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Rapport détaillé d'accident (Police)</h1>
            <a href="{{ route('signalements.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-700">
                Retour à la liste
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

        <form action="{{ route('police.signalements.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden">
            @csrf
            
            <!-- Basic Information Section -->
            <div class="p-6 border-b">
                <h2 class="text-lg font-medium text-gray-900 mb-3">Informations de base</h2>
                
                <!-- Type of accident -->
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type d'accident</label>
                    <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionnez un type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description détaillée</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">
                        Veuillez décrire le déroulement de l'accident et tout détail pertinent.
                    </p>
                </div>
                
                <!-- Accident Date and Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="accident_date" class="block text-sm font-medium text-gray-700 mb-1">Date de l'accident</label>
                        <input type="date" id="accident_date" name="accident_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('accident_date') }}" required>
                    </div>
                    <div>
                        <label for="accident_time" class="block text-sm font-medium text-gray-700 mb-1">Heure de l'accident</label>
                        <input type="time" id="accident_time" name="accident_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('accident_time') }}" required>
                    </div>
                </div>
                
                <!-- Location -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Localisation de l'accident</label>
                    <div id="map" class="w-full h-64 border border-gray-300 rounded-md mb-2"></div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="point_x" class="block text-xs font-medium text-gray-500">Latitude</label>
                            <input type="number" step="any" id="point_x" name="point_x" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" value="{{ old('point_x') }}" required>
                        </div>
                        <div>
                            <label for="point_y" class="block text-xs font-medium text-gray-500">Longitude</label>
                            <input type="number" step="any" id="point_y" name="point_y" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" value="{{ old('point_y') }}" required>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Cliquez sur la carte pour définir la position exacte de l'accident.
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
                            <option value="Highway" {{ old('road_type') == 'Highway' ? 'selected' : '' }}>Autoroute</option>
                            <option value="Urban road" {{ old('road_type') == 'Urban road' ? 'selected' : '' }}>Route urbaine</option>
                            <option value="Rural road" {{ old('road_type') == 'Rural road' ? 'selected' : '' }}>Route rurale</option>
                        </select>
                    </div>
                    
                    <!-- Road Condition -->
                    <div>
                        <label for="road_condition" class="block text-sm font-medium text-gray-700 mb-1">État de la route</label>
                        <select id="road_condition" name="road_condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Sélectionnez un état</option>
                            <option value="Dry" {{ old('road_condition') == 'Dry' ? 'selected' : '' }}>Sec</option>
                            <option value="Wet" {{ old('road_condition') == 'Wet' ? 'selected' : '' }}>Mouillé</option>
                            <option value="Damaged" {{ old('road_condition') == 'Damaged' ? 'selected' : '' }}>Endommagé</option>
                        </select>
                    </div>
                    
                    <!-- Weather Condition -->
                    <div>
                        <label for="weather_condition" class="block text-sm font-medium text-gray-700 mb-1">Conditions météorologiques</label>
                        <select id="weather_condition" name="weather_condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Sélectionnez une condition</option>
                            <option value="Sunny" {{ old('weather_condition') == 'Sunny' ? 'selected' : '' }}>Ensoleillé</option>
                            <option value="Rainy" {{ old('weather_condition') == 'Rainy' ? 'selected' : '' }}>Pluvieux</option>
                            <option value="Foggy" {{ old('weather_condition') == 'Foggy' ? 'selected' : '' }}>Brumeux</option>
                        </select>
                    </div>
                    
                    <!-- Lighting -->
                    <div>
                        <label for="lighting" class="block text-sm font-medium text-gray-700 mb-1">Éclairage</label>
                        <select id="lighting" name="lighting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Sélectionnez un éclairage</option>
                            <option value="Daylight" {{ old('lighting') == 'Daylight' ? 'selected' : '' }}>Jour</option>
                            <option value="Night" {{ old('lighting') == 'Night' ? 'selected' : '' }}>Nuit</option>
                            <option value="Low light" {{ old('lighting') == 'Low light' ? 'selected' : '' }}>Faible luminosité</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Vehicle Information Section -->
            <div class="p-6 border-b bg-green-50">
                <h2 class="text-lg font-medium text-gray-900 mb-3">Informations sur les véhicules impliqués</h2>
                <p class="mb-4 text-sm text-gray-600">
                    Ces informations sont essentielles pour l'analyse et la simulation de l'accident dans MATLAB.
                </p>
                
                <div class="mb-4">
                    <label for="vehicle_count" class="block text-sm font-medium text-gray-700 mb-1">Nombre de véhicules impliqués</label>
                    <select id="vehicle_count" name="vehicle_count" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionnez le nombre</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ old('vehicle_count') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                
                <div id="vehicle-forms-container">
                    <!-- Vehicle forms will be dynamically added here -->
                </div>
            </div>

            <!-- Victim Information Section -->
            <div class="p-6 border-b bg-red-50">
                <h2 class="text-lg font-medium text-gray-900 mb-3">Informations sur les victimes</h2>
                <p class="mb-4 text-sm text-gray-600">
                    Ces informations sont essentielles pour l'analyse de l'impact de l'accident sur les personnes impliquées.
                </p>
                
                <div class="mb-4">
                    <label for="victim_count" class="block text-sm font-medium text-gray-700 mb-1">Nombre de victimes</label>
                    <select id="victim_count" name="victim_count" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="0" {{ old('victim_count') == 0 ? 'selected' : '' }}>0 (Aucune victime)</option>
                        @for ($i = 1; $i <= 20; $i++)
                            <option value="{{ $i }}" {{ old('victim_count') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                
                <div id="victim-forms-container">
                    <!-- Victim forms will be dynamically added here -->
                </div>
            </div>

            <!-- Additional Attachments Section -->
            <div class="p-6 border-b bg-yellow-50">
                <h2 class="text-lg font-medium text-gray-900 mb-3">Pièces jointes supplémentaires</h2>
                <p class="mb-4 text-sm text-gray-600">
                    Ajoutez des photos de l'accident et des notes supplémentaires pour une documentation plus précise et une meilleure analyse dans MATLAB.
                </p>
                
                <!-- Accident Photos -->
                <div class="mb-4">
                    <label for="accident_photos" class="block text-sm font-medium text-gray-700 mb-1">Photos de l'accident</label>
                    <input type="file" id="accident_photos" name="accident_photos[]" multiple class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100">
                    <p class="mt-1 text-sm text-gray-500">
                        Vous pouvez télécharger plusieurs photos pour documenter la scène de l'accident. Formats acceptés : JPG, JPEG, PNG.
                    </p>
                    <div id="accident-photo-preview" class="grid grid-cols-3 gap-2 mt-2"></div>
                </div>
                
                <!-- Additional Notes -->
                <div>
                    <label for="additional_notes" class="block text-sm font-medium text-gray-700 mb-1">Notes supplémentaires</label>
                    <textarea id="additional_notes" name="additional_notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ajoutez toute information supplémentaire pertinente concernant l'accident...">{{ old('additional_notes') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">
                        Incluez des détails comme les circonstances de l'accident, les déclarations des témoins ou toute autre information qui pourrait être utile pour l'enquête ou la simulation.
                    </p>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="px-6 py-4 bg-gray-50 text-right">
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm">
                    Soumettre le rapport d'accident
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Template for vehicle form -->
<template id="vehicle-form-template">
    <div class="vehicle-form mb-6 p-3 border border-gray-200 rounded bg-gray-50">
        <h3 class="font-medium text-gray-800 mb-3">Véhicule <span class="vehicle-number"></span></h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Type of vehicle -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type de véhicule</label>
                <select class="vehicle-type mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Sélectionnez un type</option>
                    <option value="Car">Voiture</option>
                    <option value="Truck">Camion</option>
                    <option value="Motorcycle">Moto</option>
                    <option value="Bicycle">Vélo</option>
                </select>
            </div>
            
            <!-- Approximate speed -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Vitesse approximative (km/h)</label>
                <input type="number" class="vehicle-speed mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" min="0" required>
            </div>
            
            <!-- Direction of travel -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Direction</label>
                <select class="vehicle-direction mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Sélectionnez une direction</option>
                    <option value="North">Nord</option>
                    <option value="South">Sud</option>
                    <option value="East">Est</option>
                    <option value="West">Ouest</option>
                </select>
            </div>
            
            <!-- Driver condition -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">État du conducteur</label>
                <select class="vehicle-driver-condition mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Sélectionnez l'état</option>
                    <option value="Healthy">Sain</option>
                    <option value="Injured">Blessé</option>
                    <option value="Under the influence of alcohol">Sous l'influence d'alcool</option>
                    <option value="Under the influence of drugs">Sous l'influence de drogues</option>
                </select>
            </div>
            
            <!-- Vehicle position -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Position du véhicule (latitude, longitude)</label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="number" class="vehicle-latitude mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Latitude" step="any" required>
                    <input type="number" class="vehicle-longitude mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Longitude" step="any" required>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Cliquez sur la carte pour définir la position ou entrez manuellement les coordonnées.
                </p>
            </div>
        </div>
    </div>
</template>

<!-- Template for victim form -->
<template id="victim-form-template">
    <div class="victim-form mb-6 p-3 border border-red-200 rounded bg-red-50">
        <h3 class="font-medium text-gray-800 mb-3">Victime <span class="victim-number"></span></h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Role of victim -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rôle de la victime</label>
                <select class="victim-role mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Sélectionnez un rôle</option>
                    <option value="Driver">Conducteur</option>
                    <option value="Passenger">Passager</option>
                    <option value="Pedestrian">Piéton</option>
                    <option value="Cyclist">Cycliste</option>
                    <option value="Other">Autre</option>
                </select>
            </div>
            
            <!-- Type of injury -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type de blessure</label>
                <select class="victim-injury-type mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Sélectionnez une blessure</option>
                    <option value="None">Aucune</option>
                    <option value="Minor">Légère</option>
                    <option value="Moderate">Moyenne</option>
                    <option value="Severe">Grave</option>
                    <option value="Fatal">Fatale</option>
                </select>
            </div>
            
            <!-- Age (optional) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Âge (optionnel)</label>
                <input type="number" class="victim-age mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" min="0" max="120">
            </div>
            
            <!-- Gender (optional) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Genre (optionnel)</label>
                <select class="victim-gender mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Non spécifié</option>
                    <option value="Male">Homme</option>
                    <option value="Female">Femme</option>
                    <option value="Other">Autre</option>
                </select>
            </div>
            
            <!-- Additional notes -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Notes supplémentaires</label>
                <textarea class="victim-notes mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="2" placeholder="Informations supplémentaires sur cette victime..."></textarea>
            </div>
        </div>
    </div>
</template>

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
        
        // If coordinates are already set (e.g. from validation error), show marker
        const lat = document.getElementById('point_x').value;
        const lng = document.getElementById('point_y').value;
        
        if (lat && lng) {
            const latlng = L.latLng(lat, lng);
            marker = L.marker(latlng).addTo(map);
            map.setView(latlng, 15);
        }
        
        // Vehicle and victim forms handling
        const vehicleCountSelect = document.getElementById('vehicle_count');
        const vehicleFormsContainer = document.getElementById('vehicle-forms-container');
        const vehicleFormTemplate = document.getElementById('vehicle-form-template').content;
        
        const victimCountSelect = document.getElementById('victim_count');
        const victimFormsContainer = document.getElementById('victim-forms-container');
        const victimFormTemplate = document.getElementById('victim-form-template').content;
        
        // Function to update vehicle forms when count changes
        function updateVehicleForms() {
            // Clear existing forms
            vehicleFormsContainer.innerHTML = '';
            
            const count = parseInt(vehicleCountSelect.value);
            if (isNaN(count)) return;
            
            // Add new forms
            for (let i = 0; i < count; i++) {
                const vehicleIndex = i;
                const vehicleNumber = i + 1;
                
                // Clone template
                const formClone = document.importNode(vehicleFormTemplate, true);
                
                // Set form number
                formClone.querySelector('.vehicle-number').textContent = vehicleNumber;
                
                // Set field names
                formClone.querySelector('.vehicle-type').name = `vehicle_types[${vehicleIndex}]`;
                formClone.querySelector('.vehicle-speed').name = `vehicle_speeds[${vehicleIndex}]`;
                formClone.querySelector('.vehicle-direction').name = `vehicle_directions[${vehicleIndex}]`;
                formClone.querySelector('.vehicle-latitude').name = `vehicle_latitudes[${vehicleIndex}]`;
                formClone.querySelector('.vehicle-longitude').name = `vehicle_longitudes[${vehicleIndex}]`;
                formClone.querySelector('.vehicle-driver-condition').name = `driver_conditions[${vehicleIndex}]`;
                
                vehicleFormsContainer.appendChild(formClone);
            }
        }
        
        // Function to update victim forms when count changes
        function updateVictimForms() {
            // Clear existing forms
            victimFormsContainer.innerHTML = '';
            
            const count = parseInt(victimCountSelect.value);
            if (isNaN(count) || count === 0) return;
            
            // Add new forms
            for (let i = 0; i < count; i++) {
                const victimIndex = i;
                const victimNumber = i + 1;
                
                // Clone template
                const formClone = document.importNode(victimFormTemplate, true);
                
                // Set form number
                formClone.querySelector('.victim-number').textContent = victimNumber;
                
                // Set field names
                formClone.querySelector('.victim-role').name = `victim_roles[${victimIndex}]`;
                formClone.querySelector('.victim-injury-type').name = `victim_injury_types[${victimIndex}]`;
                formClone.querySelector('.victim-age').name = `victim_ages[${victimIndex}]`;
                formClone.querySelector('.victim-gender').name = `victim_genders[${victimIndex}]`;
                formClone.querySelector('.victim-notes').name = `victim_notes[${victimIndex}]`;
                
                victimFormsContainer.appendChild(formClone);
            }
        }
        
        // Initial setup
        vehicleCountSelect.addEventListener('change', updateVehicleForms);
        victimCountSelect.addEventListener('change', updateVictimForms);
        
        // Set up initial forms if a count is pre-selected (e.g. from validation error)
        if (vehicleCountSelect.value) {
            updateVehicleForms();
        }
        
        if (victimCountSelect.value) {
            updateVictimForms();
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