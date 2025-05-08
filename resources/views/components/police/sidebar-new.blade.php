@php
$currentRoute = Route::currentRouteName();
$user = Auth::user();
@endphp

<div class="fixed inset-y-0 left-0 w-64 bg-blue-900 shadow-lg z-20 overflow-y-auto transition-transform duration-300 transform" id="police-sidebar">
    <!-- Police Logo and Title -->
    <div class="flex items-center justify-between p-4 bg-blue-950">
        <div class="flex items-center space-x-3">
            <div class="bg-white p-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L9.5 7L3 8.5L7.5 13L6 19.5L12 16.5L18 19.5L16.5 13L21 8.5L14.5 7L12 2Z" />
                </svg>
            </div>
            <div>
                <h1 class="text-white font-bold text-xl">Police</h1>
                <p class="text-blue-300 text-xs">Système de gestion</p>
            </div>
        </div>
        <button class="text-white lg:hidden" id="close-sidebar">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- User Profile Section -->
    <div class="p-4 border-t border-b border-blue-800">
        <div class="flex items-center bg-blue-800/30 p-3 rounded-lg">
            <div class="relative">
                @if($user)
                    <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='. urlencode($user->name ?? 'Police User') .'&color=FFFFFF&background=3B82F6' }}" 
                         alt="Profile" 
                         class="w-12 h-12 rounded-full border-2 border-white">
                @else
                    <img src="https://ui-avatars.com/api/?name=Police+User&color=FFFFFF&background=3B82F6" 
                         alt="Profile" 
                         class="w-12 h-12 rounded-full border-2 border-white">
                @endif
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
            </div>
            <div class="ml-3">
                <p class="text-white font-medium">{{ $user ? $user->name : 'Invité' }}</p>
                <p class="text-blue-300 text-xs">Officier de Police</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="px-2 py-4">
        <div class="mb-2 px-4 text-xs font-semibold text-blue-400 uppercase">Menu Principal</div>
        
        <a href="{{ route('police.dashboard') }}" class="flex items-center py-2.5 px-4 rounded-lg mb-1 {{ $currentRoute === 'police.dashboard' ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800/40' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            Tableau de Bord
        </a>
        
        <a href="{{ route('police.signalements.index') }}" class="flex items-center py-2.5 px-4 rounded-lg mb-1 {{ strpos($currentRoute, 'police.signalements.index') === 0 ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800/40' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
            Signalements
        </a>
        
        <a href="{{ route('police.accidents') }}" class="flex items-center py-2.5 px-4 rounded-lg mb-1 {{ $currentRoute === 'police.accidents' ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800/40' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V8h4.5v6a1 1 0 00.7.967l.8.166A2.5 2.5 0 0119 16.5h.5a1 1 0 001-1v-6a2 2 0 00-2-2h-4.44L13 3.9a1 1 0 00-.9-.5H3z" />
            </svg>
            Accidents
        </a>

        <div class="mb-2 mt-6 px-4 text-xs font-semibold text-blue-400 uppercase">Actions Rapides</div>
        
        <a href="{{ route('police.signalements.create') }}" class="flex items-center py-2.5 px-4 rounded-lg mb-1 {{ $currentRoute === 'police.signalements.create' ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800/40' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
            Nouveau Rapport
        </a>
        
        <a href="{{ route('signalements.map') }}" class="flex items-center py-2.5 px-4 rounded-lg mb-1 {{ $currentRoute === 'signalements.map' ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800/40' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
            </svg>
            Carte Interactive
        </a>
        
        <div class="border-t border-blue-800 my-4"></div>
        
        <a href="{{ route('logout') }}" class="flex items-center py-2.5 px-4 rounded-lg text-blue-100 hover:bg-red-500/20 hover:text-red-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Déconnexion
        </a>
    </nav>
</div>

<!-- Mobile menu button -->
<div class="fixed bottom-4 left-4 z-40 lg:hidden">
    <button id="open-sidebar" class="bg-blue-700 text-white p-3 rounded-full shadow-lg hover:bg-blue-800 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('police-sidebar');
        const openButton = document.getElementById('open-sidebar');
        const closeButton = document.getElementById('close-sidebar');
        
        // Mobile sidebar toggle
        openButton.addEventListener('click', function() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
        });
        
        closeButton.addEventListener('click', function() {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
        });
        
        // Default state for mobile
        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
        }
    });
</script>
@endpush