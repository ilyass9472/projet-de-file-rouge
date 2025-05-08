@extends('layouts.app')

@section('content')
@include('componnents.navbar')
<section class="min-h-screen py-12 bg-gradient-to-br from-black via-blue-900 to-black px-4">
    <form action="{{ route('signalements.store') }}" method="POST" 
          class="max-w-4xl mx-auto p-8 backdrop-blur-xl bg-black/40 rounded-3xl 
                 shadow-[0_0_40px_rgba(37,99,235,0.3)] border border-blue-900/50 
                 space-y-8 transform hover:scale-[1.01] transition-all duration-500">
        @csrf
        
        <div class="text-center mb-10">
            <h2 class="text-5xl font-extrabold bg-gradient-to-r from-blue-500 via-white to-blue-500 
                       bg-clip-text text-transparent mb-4 animate-gradient">
                Nouveau Signalement
            </h2>
            <div class="h-1.5 w-32 mx-auto bg-gradient-to-r from-blue-500 via-white to-blue-500 rounded-full"></div>
        </div>

        <!-- Map Container -->
        <div class="relative group mb-8 hover:shadow-[0_0_20px_rgba(37,99,235,0.2)] transition-all duration-300">
            <label class="absolute -top-3 left-2 bg-black px-3 text-sm font-medium text-blue-500 
                         transition-all duration-300 rounded-lg z-10 backdrop-blur-sm">
                Localisation
            </label>
            <div id="map" class="w-full h-[400px] rounded-xl border-2 border-blue-900/50 overflow-hidden"></div>
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="relative group">
                <label for="type" 
                       class="absolute -top-3 left-2 bg-black px-3 text-sm font-medium text-blue-500 
                              transition-all duration-300 rounded-lg z-10 backdrop-blur-sm">
                    Type d'Incident
                </label>
                <input type="text" 
                       name="type" 
                       id="type" 
                       required
                       placeholder="Entrez le type d'incident..."
                       class="block w-full px-4 py-4 bg-black/50 border-2 border-blue-900/50 rounded-xl 
                              focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 outline-none 
                              text-white placeholder-blue-200/30 group-hover:border-blue-700">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-blue-500/50 group-hover:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>

            <div class="relative group">
                <label for="statut" 
                       class="absolute -top-3 left-2 bg-black px-3 text-sm font-medium text-blue-500 
                              transition-all duration-300 rounded-lg z-10 backdrop-blur-sm">
                    Statut
                </label>
                <select name="statut" 
                        id="statut"
                        class="block w-full px-4 py-4 bg-black/50 border-2 border-blue-900/50 rounded-xl 
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 outline-none 
                               text-white group-hover:border-blue-700">
                    <option value="nouveau" class="bg-gray-900">🌟 Nouveau</option>
                    <option value="en_cours" class="bg-gray-900">⚡ En cours</option>
                    <option value="terminé" class="bg-gray-900">✅ Terminé</option>
                </select>
            </div>
        </div>

        <div class="relative group">
            <label for="description" 
                   class="absolute -top-3 left-2 bg-black px-3 text-sm font-medium text-blue-500 
                          transition-all duration-300 rounded-lg z-10 backdrop-blur-sm">
                Description Détaillée
            </label>
            <textarea name="description" 
                      id="description" 
                      required
                      placeholder="Décrivez l'incident en détail..."
                      class="block w-full px-4 py-4 bg-black/50 border-2 border-blue-900/50 rounded-xl 
                             focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 outline-none 
                             min-h-[200px] resize-none text-white placeholder-blue-200/30 
                             group-hover:border-blue-700"></textarea>
        </div>

        <button type="submit" 
                class="w-full relative overflow-hidden group bg-gradient-to-r from-blue-800 via-blue-600 to-blue-800 
                       text-white font-bold py-5 px-6 rounded-xl transition-all duration-500 
                       transform hover:scale-[1.02] hover:shadow-[0_0_30px_rgba(37,99,235,0.5)]">
            <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-500"></span>
            <div class="flex items-center justify-center space-x-3">
                <svg class="w-6 h-6 transform group-hover:rotate-180 transition-transform duration-500" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span class="text-lg tracking-wider">Soumettre le Signalement</span>
            </div>
            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-blue-800 via-blue-600 to-blue-800 
                        opacity-0 group-hover:opacity-50 blur-xl transition-opacity duration-500"></div>
        </button>
    </form>
</section>
@endsection

<style>
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .animate-gradient {
        background-size: 200% auto;
        animation: gradient 6s linear infinite;
    }

    /* Glowing effect */
    .glow-effect {
        box-shadow: 0 0 15px rgba(37,99,235,0.3);
        animation: glow 2s infinite alternate;
    }

    @keyframes glow {
        from { box-shadow: 0 0 15px rgba(37,99,235,0.3); }
        to { box-shadow: 0 0 25px rgba(37,99,235,0.5); }
    }

    textarea::-webkit-scrollbar {
        width: 8px;
    }
    
    textarea::-webkit-scrollbar-track {
        background: rgba(37,99,235,0.1);
        border-radius: 4px;
    }
    
    textarea::-webkit-scrollbar-thumb {
        background: rgba(37,99,235,0.3);
        border-radius: 4px;
    }
    
    textarea::-webkit-scrollbar-thumb:hover {
        background: rgba(37,99,235,0.5);
    }
</style>