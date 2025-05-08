@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    <!-- Include sidebar directly without the container div -->
    @include('components.admin.sideBar')
    
    <div class="pl-64 w-full p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Paramètres du système</h1>
            <p class="text-gray-600 mt-1">Personnalisez l'apparence et les fonctionnalités de votre dashboard.</p>
        </div>

        <!-- Theme Settings -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="theme-header px-6 py-4 border-b">
                <h2 class="text-lg font-medium text-white">Thèmes de l'interface</h2>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-4">Choisissez un thème de couleur pour personnaliser l'apparence de votre interface administrative.</p>
                
                <form action="{{ route('admin.settings.update-theme') }}" method="POST" id="themeForm">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Default Theme -->
                        <div class="theme-option rounded-lg overflow-hidden border-2 transition-all cursor-pointer hover:shadow-lg" data-theme="default">
                            <div class="theme-header h-24 bg-gradient-to-r from-blue-600 to-indigo-700"></div>
                            <div class="p-4 bg-white">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-800">Bleu (Défaut)</span>
                                    <span class="theme-check text-blue-600 hidden"><i class="fas fa-check-circle"></i></span>
                                </div>
                                <div class="mt-2 flex space-x-2">
                                    <span class="w-6 h-6 rounded-full bg-blue-600"></span>
                                    <span class="w-6 h-6 rounded-full bg-indigo-700"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dark Theme -->
                        <div class="theme-option rounded-lg overflow-hidden border-2 transition-all cursor-pointer hover:shadow-lg" data-theme="dark">
                            <div class="theme-header h-24 bg-gradient-to-r from-gray-800 to-gray-900"></div>
                            <div class="p-4 bg-white">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-800">Sombre</span>
                                    <span class="theme-check text-blue-600 hidden"><i class="fas fa-check-circle"></i></span>
                                </div>
                                <div class="mt-2 flex space-x-2">
                                    <span class="w-6 h-6 rounded-full bg-gray-800"></span>
                                    <span class="w-6 h-6 rounded-full bg-gray-900"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Green Theme -->
                        <div class="theme-option rounded-lg overflow-hidden border-2 transition-all cursor-pointer hover:shadow-lg" data-theme="green">
                            <div class="theme-header h-24 bg-gradient-to-r from-green-600 to-teal-500"></div>
                            <div class="p-4 bg-white">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-800">Vert</span>
                                    <span class="theme-check text-blue-600 hidden"><i class="fas fa-check-circle"></i></span>
                                </div>
                                <div class="mt-2 flex space-x-2">
                                    <span class="w-6 h-6 rounded-full bg-green-600"></span>
                                    <span class="w-6 h-6 rounded-full bg-teal-500"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Purple Theme -->
                        <div class="theme-option rounded-lg overflow-hidden border-2 transition-all cursor-pointer hover:shadow-lg" data-theme="purple">
                            <div class="theme-header h-24 bg-gradient-to-r from-purple-600 to-pink-500"></div>
                            <div class="p-4 bg-white">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-800">Violet</span>
                                    <span class="theme-check text-blue-600 hidden"><i class="fas fa-check-circle"></i></span>
                                </div>
                                <div class="mt-2 flex space-x-2">
                                    <span class="w-6 h-6 rounded-full bg-purple-600"></span>
                                    <span class="w-6 h-6 rounded-full bg-pink-500"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Red Theme -->
                        <div class="theme-option rounded-lg overflow-hidden border-2 transition-all cursor-pointer hover:shadow-lg" data-theme="red">
                            <div class="theme-header h-24 bg-gradient-to-r from-red-600 to-orange-500"></div>
                            <div class="p-4 bg-white">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-800">Rouge</span>
                                    <span class="theme-check text-blue-600 hidden"><i class="fas fa-check-circle"></i></span>
                                </div>
                                <div class="mt-2 flex space-x-2">
                                    <span class="w-6 h-6 rounded-full bg-red-600"></span>
                                    <span class="w-6 h-6 rounded-full bg-orange-500"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Amber Theme -->
                        <div class="theme-option rounded-lg overflow-hidden border-2 transition-all cursor-pointer hover:shadow-lg" data-theme="amber">
                            <div class="theme-header h-24 bg-gradient-to-r from-yellow-500 to-amber-600"></div>
                            <div class="p-4 bg-white">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-800">Ambre</span>
                                    <span class="theme-check text-blue-600 hidden"><i class="fas fa-check-circle"></i></span>
                                </div>
                                <div class="mt-2 flex space-x-2">
                                    <span class="w-6 h-6 rounded-full bg-yellow-500"></span>
                                    <span class="w-6 h-6 rounded-full bg-amber-600"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="theme" id="selected-theme" value="{{ session('admin_theme', 'default') }}">
                    
                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 theme-button border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 focus:outline-none focus:ring ring-opacity-30 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-save mr-2"></i> Enregistrer les préférences
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Theme Preview -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-lg font-medium text-gray-900">Aperçu du thème</h2>
            </div>
            <div class="p-6">
                <div id="theme-preview" class="border rounded-lg overflow-hidden">
                    <div class="preview-header h-16 flex items-center justify-between px-6 text-white">
                        <div class="flex items-center">
                            <div class="preview-icon mr-3 h-8 w-8 flex items-center justify-center rounded-full bg-white bg-opacity-20">
                                <i class="fas fa-chart-line text-sm"></i>
                            </div>
                            <h3 class="font-medium">Dashboard Analytics</h3>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="w-8 h-8 flex items-center justify-center rounded-full bg-white bg-opacity-20">
                                <i class="fas fa-bell text-sm"></i>
                            </span>
                            <span class="w-8 h-8 flex items-center justify-center rounded-full bg-white bg-opacity-20">
                                <i class="fas fa-user text-sm"></i>
                            </span>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50">
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="preview-card rounded-lg p-4 bg-white shadow">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-sm font-medium">Signalements</h4>
                                    <span class="text-xs preview-icon-sm h-6 w-6 flex items-center justify-center rounded-full">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                </div>
                                <p class="text-xl font-bold">128</p>
                                <div class="text-xs text-green-600 mt-1">+12% ce mois</div>
                            </div>
                            <div class="preview-card rounded-lg p-4 bg-white shadow">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-sm font-medium">Utilisateurs</h4>
                                    <span class="text-xs preview-icon-sm h-6 w-6 flex items-center justify-center rounded-full">
                                        <i class="fas fa-users"></i>
                                    </span>
                                </div>
                                <p class="text-xl font-bold">1,452</p>
                                <div class="text-xs text-green-600 mt-1">+5% cette semaine</div>
                            </div>
                            <div class="preview-card rounded-lg p-4 bg-white shadow">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-sm font-medium">Accidents</h4>
                                    <span class="text-xs preview-icon-sm h-6 w-6 flex items-center justify-center rounded-full">
                                        <i class="fas fa-car-crash"></i>
                                    </span>
                                </div>
                                <p class="text-xl font-bold">85</p>
                                <div class="text-xs text-red-600 mt-1">-3% ce mois</div>
                            </div>
                        </div>
                        <div class="preview-button py-2 px-4 rounded text-white text-center text-sm">
                            Voir les rapports
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .theme-option {
        border-color: #e5e7eb;
    }
    
    .theme-option.active {
        border-color: #3b82f6;
    }
    
    .theme-option.active .theme-check {
        display: block;
    }
    
    #theme-preview .preview-header {
        background-image: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    }
    
    #theme-preview .preview-icon-sm {
        color: white;
        background-image: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    }
    
    #theme-preview .preview-button {
        background-image: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    }
    
    @media (max-width: 768px) {
        .pl-64 {
            padding-left: 0;
            width: 100%;
        }
        
        .menu-toggle {
            display: block;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 30;
            background: var(--primary-color);
            color: white;
            padding: 0.5rem;
            border-radius: 0.25rem;
        }
        
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .sidebar.active {
            transform: translateX(0);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initial theme setup
        const currentTheme = "{{ session('admin_theme', 'default') }}";
        setActiveTheme(currentTheme);
        
        // Theme selection
        const themeOptions = document.querySelectorAll('.theme-option');
        themeOptions.forEach(option => {
            option.addEventListener('click', function() {
                const theme = this.dataset.theme;
                setActiveTheme(theme);
                document.getElementById('selected-theme').value = theme;
                
                // Update theme preview
                updateThemePreview(theme);
            });
        });
        
        // Initialize theme preview
        updateThemePreview(currentTheme);
        
        // Menu toggle for mobile
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }
        
        function setActiveTheme(theme) {
            // Remove active class from all options
            themeOptions.forEach(opt => {
                opt.classList.remove('active');
            });
            
            // Add active class to selected theme
            const selectedOption = document.querySelector(`.theme-option[data-theme="${theme}"]`);
            if (selectedOption) {
                selectedOption.classList.add('active');
            }
        }
        
        function updateThemePreview(theme) {
            const preview = document.getElementById('theme-preview');
            preview.setAttribute('data-theme', theme);
        }
    });
</script>
@endsection