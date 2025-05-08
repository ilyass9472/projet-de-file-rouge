@extends('layouts.app')

@section('content')
<div class="relative bg-white min-h-screen">
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    <div class="absolute top-0 right-0 w-1/3 h-screen z-0"></div>
    <div class="relative pt-8 pb-10 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 animate__animated animate__fadeIn">
            <h1 class="text-3xl md:text-4xl font-bold text-red-600 mb-2 animate__animated animate__slideInDown bloodtext">
                Signalement d'Accident & Suivi de Dossier
            </h1>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto animate__animated animate__fadeIn animate__delay-1s">
                Déclarez un accident et suivez l'évolution de vos dossiers en temps réel
            </p>
        </div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        @if(isset($error))
        <div class="bg-red-100 border border-red-600 text-red-800 px-4 py-3 rounded mb-6 flex items-center animate__animated animate__shakeX">
            <svg class="h-6 w-6 text-red-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>{{ $error }}</span>
        </div>
        @endif

        @if(!Auth::check())
        <div class="text-center py-8">
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-red-200 max-w-3xl mx-auto transform hover:scale-105 transition-all duration-300 animate__animated animate__fadeIn hover:border-red-300 hover:shadow-red-200 hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-600 mx-auto mb-4 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Connectez-vous pour accéder à votre espace personnel</h2>
                <p class="text-gray-700 mb-6">Pour signaler un accident ou suivre vos dossiers existants, veuillez vous connecter à votre compte.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-300 shadow-lg shadow-red-100 transform hover:translate-y-[-4px]">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-900 font-medium rounded-lg border border-gray-300 transition-all duration-300 transform hover:translate-y-[-4px] hover:border-red-300">
                        Créer un compte
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 transform transition-all duration-300 hover:bg-gray-50 hover:shadow-lg hover:shadow-red-100 hover:border-red-200 animate__animated animate__fadeInUp">
                    <div class="bg-red-100 rounded-full p-3 w-16 h-16 flex items-center justify-center mx-auto mb-4 transition-all duration-300 group-hover:bg-red-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-red-600 mb-2 text-center">Guide de signalement</h3>
                    <p class="text-gray-700 text-center">Apprenez comment signaler un accident et quels documents fournir.</p>
                </div>
                
                <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 transform transition-all duration-300 hover:bg-gray-50 hover:shadow-lg hover:shadow-red-100 hover:border-red-200 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="bg-red-100 rounded-full p-3 w-16 h-16 flex items-center justify-center mx-auto mb-4 transition-all duration-300 group-hover:bg-red-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-red-600 mb-2 text-center">Procédure de traitement</h3>
                    <p class="text-gray-700 text-center">Découvrez les étapes du traitement de votre signalement d'accident.</p>
                </div>
                
                <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 transform transition-all duration-300 hover:bg-gray-50 hover:shadow-lg hover:shadow-red-100 hover:border-red-200 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="bg-red-100 rounded-full p-3 w-16 h-16 flex items-center justify-center mx-auto mb-4 transition-all duration-300 group-hover:bg-red-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-red-600 mb-2 text-center">Questions fréquentes</h3>
                    <p class="text-gray-700 text-center">Consultez notre FAQ pour répondre à vos questions courantes.</p>
                </div>
            </div>
        </div>
        @else
        @if(isset($inProgressReport) && $inProgressReport)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-red-600 mb-4 bloodtext">Continuer Votre Signalement</h2>
            <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 mb-4">
                <x-accident-progress-tracker :currentStep="$currentStep ?? 1" :progress="$progress ?? 20" />
                
                <div class="mt-6 flex justify-center">
                    <a href="{{ route('signalements.edit', $inProgressReport->id) }}" class="px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-medium rounded-lg transition-all shadow-lg hover:shadow-red-200 hover:-translate-y-1 animate-pulse">
                        Continuer le signalement
                    </a>
                </div>
            </div>
        </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <!-- Stat Card: Signalements Total -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-red-200 hover:shadow-lg transition-all duration-300">
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">Signalements</h3>
                        <div class="bg-red-100 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold">{{ $stats['total'] ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Total de vos signalements</p>
                    </div>
                </div>
            </div>
            
            <!-- Stat Card: En Cours with Trend -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300">
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">En Cours</h3>
                        <div class="bg-blue-100 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold">{{ $stats['en_cours'] ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Signalements en traitement</p>
                    </div>
                    <div class="mt-2 flex items-center text-sm">
                        <span class="text-green-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            5%
                        </span>
                        <span class="ml-1 text-gray-500">par rapport au mois dernier</span>
                    </div>
                </div>
            </div>
            
            <!-- Stat Card: Traités -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-red-200 hover:shadow-lg transition-all duration-300">
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">Traités</h3>
                        <div class="bg-red-100 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold">{{ $stats['traite'] ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Signalements complétés</p>
                    </div>
                </div>
            </div>
            
            <!-- Stat Card: Urgents with Trend -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300">
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">Urgents</h3>
                        <div class="bg-yellow-100 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-2xl font-bold">{{ $stats['urgents'] ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Accidents critiques</p>
                    </div>
                    <div class="mt-2 flex items-center text-sm">
                        <span class="text-red-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                            12%
                        </span>
                        <span class="ml-1 text-gray-500">depuis le mois dernier</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-200 hover:transform hover:scale-[1.01] transition-all duration-300 hover:border-red-200 hover:shadow-red-100">
                <div class="flex items-start mb-6">
                    <div class="bg-red-100 rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-red-600 mb-2">Signaler un Accident</h2>
                        <p class="text-gray-700">Créez un nouveau signalement en fournissant les détails de l'accident</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <p class="text-gray-700">
                        Notre système vous permet de documenter rapidement tous les aspects de l'accident:
                    </p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Localisation précise de l'accident
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Photos des dommages
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Informations sur les véhicules impliqués
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Détails des personnes impliquées
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('signalements.create') }}" class="block w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition duration-300 shadow-lg hover:shadow-red-200 hover:from-red-700 hover:to-red-800 border border-red-500">
                        Nouveau Signalement
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-200 hover:transform hover:scale-[1.01] transition-all duration-300 hover:border-red-200 hover:shadow-red-100">
                <div class="flex items-start mb-6">
                    <div class="bg-red-100 rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-red-600 mb-2">Suivi de Dossier</h2>
                        <p class="text-gray-700">Consultez et gérez vos signalements et dossiers existants</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <p class="text-gray-700">
                        Suivez l'évolution de vos dossiers à chaque étape du processus:
                    </p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Statut actuel de traitement
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Communications avec les autorités
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Téléchargement de documents
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Décisions et résolutions
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('signalements.index') }}" class="block w-full bg-gradient-to-r from-gray-600 to-gray-800 text-white font-semibold py-3 px-4 rounded-lg text-center transition duration-300 shadow-lg hover:shadow-red-200 hover:from-gray-700 hover:to-gray-900 border border-gray-500">
                        Voir Mes Dossiers
                    </a>
                </div>
            </div>
        </div>
        @if(isset($accidentMarkers) && count($accidentMarkers) > 0)
        <div class="mt-12 animate__animated animate__fadeIn">
            <h2 class="text-2xl font-bold text-red-600 mb-4">Carte des Accidents Récents</h2>
            <div class="bg-white shadow-lg rounded-xl p-4 border border-gray-200 hover:border-red-200 hover:shadow-red-100 transition-all duration-300">
                <x-accident-map :markers="$accidentMarkers" height="400" />
            </div>
        </div>
        @endif
        <div class="mt-12 animate__animated animate__fadeIn">
            <h2 class="text-2xl font-bold text-red-600 mb-2">Vos Signalements Personnels</h2>
            <p class="text-gray-700 mb-6">Vous ne voyez que les signalements que vous avez créés</p>
            
            @if(isset($signalements) && count($signalements) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
                        <thead>
                            <tr class="bg-red-100 text-left">
                                <th class="px-6 py-4 text-gray-900 font-semibold">ID</th>
                                <th class="px-6 py-4 text-gray-900 font-semibold">Date</th>
                                <th class="px-6 py-4 text-gray-900 font-semibold">Type</th>
                                <th class="px-6 py-4 text-gray-900 font-semibold">Localisation</th>
                                <th class="px-6 py-4 text-gray-900 font-semibold">Statut</th>
                                <th class="px-6 py-4 text-gray-900 font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($signalements as $signalement)
                                <tr class="hover:bg-red-50 transition-colors duration-200 transform hover:scale-[1.01]">
                                    <td class="px-6 py-4 text-gray-900">{{ $signalement->id }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ $signalement->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ $signalement->type }}</td>
                                    <td class="px-6 py-4 text-gray-900 truncate max-w-xs">{{ $signalement->point_id ? $signalement->point->localisation : 'Non spécifiée' }}</td>
                                    <td class="px-6 py-4">
                                        @if($signalement->statut == 'en_attente')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 pulse-animation">
                                                En attente
                                            </span>
                                        @elseif($signalement->statut == 'en_cours')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 pulse-animation">
                                                En cours
                                            </span>
                                        @elseif($signalement->statut == 'traite')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Traité
                                            </span>
                                        @elseif($signalement->statut == 'rejete')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Rejeté
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $signalement->statut }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('signalements.show', $signalement->id) }}" class="text-red-600 hover:text-red-800 transition-colors transform hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            @if($signalement->statut == 'en_attente')
                                                <a href="{{ route('signalements.edit', $signalement->id) }}" class="text-red-600 hover:text-red-800 transition-colors transform hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white shadow-md rounded-xl p-8 text-center border border-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-lg text-gray-700">Vous n'avez pas encore de signalements personnels</p>
                    <div class="mt-4">
                        <a href="{{ route('signalements.create') }}" class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 transition duration-300">
                            Créer votre premier signalement
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div class="mt-12">
            <div class="bg-white shadow-lg rounded-xl p-6 border border-red-200 hover:border-red-300 transform hover:scale-[1.01] transition-all duration-300">
                <h3 class="text-xl font-bold text-red-600 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 mr-2 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Contacts d'Urgence
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-lg border border-red-200 hover:bg-red-50 hover:border-red-300 transform hover:scale-105 transition-all duration-300 shadow-md">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mt-0.5 mr-3 emergency-icon-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <p class="text-gray-800 font-medium">Police</p>
                                <p class="text-2xl font-bold text-red-600">190</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-red-200 hover:bg-red-50 hover:border-red-300 transform hover:scale-105 transition-all duration-300 shadow-md">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mt-0.5 mr-3 emergency-icon-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <p class="text-gray-800 font-medium">Ambulance</p>
                                <p class="text-2xl font-bold text-red-600">150</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-red-200 hover:bg-red-50 hover:border-red-300 transform hover:scale-105 transition-all duration-300 shadow-md">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mt-0.5 mr-3 emergency-icon-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <p class="text-gray-800 font-medium">Pompiers</p>
                                <p class="text-2xl font-bold text-red-600">15</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-red-200 hover:bg-red-50 hover:border-red-300 transform hover:scale-105 transition-all duration-300 shadow-md">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mt-0.5 mr-3 emergency-icon-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <p class="text-gray-800 font-medium">Urgence Européen</p>
                                <p class="text-2xl font-bold text-red-600">112</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .bg-grid-pattern {
        background-image: linear-gradient(rgba(220, 38, 38, 0.05) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(220, 38, 38, 0.05) 1px, transparent 1px);
        background-size: 30px 30px;
    }
    .blood-accent-beam {
        background: linear-gradient(to top, 
                        rgba(254, 242, 242, 0.5) 0%, 
                        rgba(252, 165, 165, 0.2) 20%, 
                        rgba(239, 68, 68, 0.2) 50%, 
                        rgba(220, 38, 38, 0.2) 70%, 
                        rgba(185, 28, 28, 0.1) 100%);
        animation: color-shift 6s infinite;
    }
    
    .bloodtext {
        text-shadow: 0 0 3px rgba(220, 38, 38, 0.4);
    }
    
    @keyframes color-shift {
        0% { opacity: 0.6; filter: hue-rotate(0deg); }
        33% { opacity: 0.8; filter: brightness(1.05); }
        66% { opacity: 0.7; filter: contrast(1.1); }
        100% { opacity: 0.6; filter: hue-rotate(0deg); }
    }
    
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.7; }
        100% { opacity: 1; }
    }
    
    .emergency-icon-pulse {
        animation: emergency-pulse 1.5s infinite;
    }
    
    @keyframes emergency-pulse {
        0% { transform: scale(1); filter: drop-shadow(0 0 1px rgba(220, 38, 38, 0.4)); }
        50% { transform: scale(1.1); filter: drop-shadow(0 0 3px rgba(220, 38, 38, 0.5)); }
        100% { transform: scale(1); filter: drop-shadow(0 0 1px rgba(220, 38, 38, 0.4)); }
    }
    
    /* Animate.css minimal implementation */
    .animate__animated {
        animation-duration: 1s;
        animation-fill-mode: both;
    }
    
    .animate__fadeIn {
        animation-name: fadeIn;
    }
    
    .animate__fadeInUp {
        animation-name: fadeInUp;
    }
    
    .animate__slideInDown {
        animation-name: slideInDown;
    }
    
    .animate__shakeX {
        animation-name: shakeX;
    }
    
    .animate__delay-1s {
        animation-delay: 0.5s;
    }
    
    .animate__delay-2s {
        animation-delay: 1s;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 40px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translate3d(0, -40px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    
    @keyframes shakeX {
        from, to { transform: translate3d(0, 0, 0); }
        10%, 30%, 50%, 70%, 90% { transform: translate3d(-5px, 0, 0); }
        20%, 40%, 60%, 80% { transform: translate3d(5px, 0, 0); }
    }
</style>

@push('scripts')
<script>
    // Add JavaScript for additional interactivity
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer to trigger animations when elements come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__fadeIn');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        // Observe all sections that should animate on scroll
        document.querySelectorAll('.mt-12').forEach(section => {
            observer.observe(section);
        });
        
        // Add hover effects to elements
        document.querySelectorAll('.text-red-600').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.3s ease';
                this.style.color = '#dc2626';
                this.style.textShadow = '0 0 3px rgba(220, 38, 38, 0.3)';
            });
            
            element.addEventListener('mouseleave', function() {
                this.style.transition = 'all 0.3s ease';
                this.style.color = '';
                this.style.textShadow = '';
            });
        });
    });
</script>
@endpush

@endsection