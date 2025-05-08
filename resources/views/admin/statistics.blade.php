@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 ml-64 mt-10">Statistiques du Système</h1>
            
            @include('components.admin.statistique')
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include Chart.js for the charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Include Leaflet.js for the map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection