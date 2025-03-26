<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignalRoute - Signalement des Problèmes Routiers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.css"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .map-container {
            height: 300px;
            width: 100%;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .report-card {
            transition: all 0.3s ease;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .image-preview {
            max-height: 200px;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .slide-in {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .success-animation {
            animation: successPop 0.5s ease-out;
        }

        @keyframes successPop {
            0% { transform: scale(0.8); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div id="successNotification" class="hidden fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 slide-in">
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>Signalement envoyé avec succès!</span>
        </div>
    </div>
    <nav class="bg-white shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-road text-2xl text-blue-600"></i>
                        <span class="text-xl font-bold text-gray-800">Signal<span class="text-blue-600">Route</span></span>
                    </div>
                    <div class="hidden md:flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition">Accueil</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition">Carte</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition">Statistiques</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button id="newReportBtn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Nouveau Signalement</span>
                    </button>
                    <button class="md:hidden text-gray-600" id="mobileMenuBtn">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Accueil</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Carte</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Statistiques</a>
            </div>
        </div>
    </nav>
        <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total Signalements</p>
                        <h3 class="text-2xl font-bold text-gray-800">1,234</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-flag text-blue-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">En cours</p>
                        <h3 class="text-2xl font-bold text-gray-800">56</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Résolus</p>
                        <h3 class="text-2xl font-bold text-gray-800">892</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Urgents</p>
                        <h3 class="text-2xl font-bold text-gray-800">23</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>
                <div class="bg-white rounded-lg shadow-md p-6 mb-8" id="reportForm">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Signaler un Problème</h2>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <i class="fas fa-clock"></i>
                            <span id="currentDateTime"></span>
                        </div>
                    </div>
        
                    <form id="incidentReportForm" class="space-y-6">
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Localisation
                            </label>
                            <div id="map" class="map-container mb-2"></div>
                            <div class="flex items-center space-x-2 mt-2">
                                <button type="button" id="getCurrentLocation" 
                                        class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-200 transition">
                                    <i class="fas fa-crosshairs mr-2"></i>Position actuelle
                                </button>
                                <input type="text" id="locationInput" placeholder="Rechercher une adresse..." 
                                       class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-exclamation-circle mr-2 text-blue-600"></i>Type de Problème
                                </label>
                                <select id="problemType" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Sélectionnez le type</option>
                                    <option value="pothole">Nid de poule</option>
                                    <option value="signage">Signalisation endommagée</option>
                                    <option value="lighting">Éclairage défectueux</option>
                                    <option value="obstruction">Obstruction</option>
                                    <option value="accident">Accident</option>
                                    <option value="flooding">Inondation</option>
                                    <option value="debris">Débris sur la route</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-exclamation-triangle mr-2 text-blue-600"></i>Niveau d'Urgence
                                </label>
                                <div class="flex space-x-4">
                                    <label class="flex-1 relative">
                                        <input type="radio" name="severity" value="low" class="peer hidden">
                                        <div class="p-3 text-center border rounded-lg cursor-pointer peer-checked:bg-green-100 peer-checked:border-green-500 peer-checked:text-green-700">
                                            <i class="fas fa-info-circle mb-1"></i>
                                            <p>Faible</p>
                                        </div>
                                    </label>
                                    <label class="flex-1 relative">
                                        <input type="radio" name="severity" value="medium" class="peer hidden">
                                        <div class="p-3 text-center border rounded-lg cursor-pointer peer-checked:bg-yellow-100 peer-checked:border-yellow-500 peer-checked:text-yellow-700">
                                            <i class="fas fa-exclamation-circle mb-1"></i>
                                            <p>Moyen</p>
                                        </div>
                                    </label>
                                    <label class="flex-1 relative">
                                        <input type="radio" name="severity" value="high" class="peer hidden">
                                        <div class="p-3 text-center border rounded-lg cursor-pointer peer-checked:bg-red-100 peer-checked:border-red-500 peer-checked:text-red-700">
                                            <i class="fas fa-exclamation-triangle mb-1"></i>
                                            <p>Urgent</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-align-left mr-2 text-blue-600"></i>Description
                            </label>
                            <textarea id="description" rows="4" 
                                      class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Décrivez le problème en détail..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-camera mr-2 text-blue-600"></i>Photos
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label class="w-full flex flex-col items-center px-4 py-6 bg-blue-50 text-blue rounded-lg tracking-wide uppercase border-2 border-dashed border-blue-400 cursor-pointer hover:bg-blue-100 transition">
                                    <i class="fas fa-cloud-upload-alt text-blue-600 text-3xl"></i>
                                    <span class="mt-2 text-base leading-normal text-blue-600">Ajouter des photos</span>
                                    <input type='file' class="hidden" multiple accept="image/*" id="photoUpload">
                                </label>
                            </div>
                            <div id="imagePreviewContainer" class="grid grid-cols-3 gap-4 mt-4"></div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition flex items-center space-x-2">
                                <i class="fas fa-paper-plane"></i>
                                <span>Envoyer le Signalement</span>
                            </button>
                        </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Signalements Récents</h2>
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition">
                                <i class="fas fa-filter mr-2"></i>Filtrer
                            </button>
                            <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition">
                                <i class="fas fa-sort mr-2"></i>Trier
                            </button>
                        </div>
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="recentReports">
                    </div>
                </div>
            </div>
        
            <script>
                mapboxgl.accessToken = 'YOUR_MAPBOX_TOKEN';
                const map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [2.3522, 48.8566],
                    zoom: 12
                });
        
                
                map.addControl(new mapboxgl.NavigationControl());
                let marker = new mapboxgl.Marker();
        
                
                document.getElementById('getCurrentLocation').addEventListener('click', () => {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(position => {
                            const { latitude, longitude } = position.coords;
                            map.flyTo({ center: [longitude, latitude], zoom: 15 });
                            marker.setLngLat([longitude, latitude]).addTo(map);
                        });
                    }
                });
        
                
                document.getElementById('photoUpload').addEventListener('change', function(e) {
                    const container = document.getElementById('imagePreviewContainer');
                    container.innerHTML = '';
                    
                    [...e.target.files].forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.className = 'relative';
                            div.innerHTML = `
                                <img src="${e.target.result}" class="image-preview w-full h-32 object-cover rounded-lg">
                                <button type="button" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            `;
                            container.appendChild(div);
                        }
                        reader.readAsDataURL(file);
                    });
                });
        
                
                document.getElementById('incidentReportForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    
                    document.getElementById('loadingOverlay').style.display = 'flex';
        
                    
                    setTimeout(() => {
                        document.getElementById('loadingOverlay').style.display = 'none';
                        
                        
                        const notification = document.getElementById('successNotification');
                        notification.classList.remove('hidden');
                        notification.classList.add('success-animation');
                        
                        setTimeout(() => {
                            notification.classList.add('hidden');
                        }, 3000);
        
                        
                        this.reset();
                        document.getElementById('imagePreviewContainer').innerHTML = '';
                    }, 2000);
                });
        
                
                function updateDateTime() {
                    const now = new Date();
                    document.getElementById('currentDateTime').textContent = now.toLocaleString();
                }
                updateDateTime();
                setInterval(updateDateTime, 1000);
        
                
                document.getElementById('mobileMenuBtn').addEventListener('click', function() {
                    document.getElementById('mobileMenu').classList.toggle('hidden');
                });
        
                
                const reportTypes = [
                    { type: 'Nid de poule', icon: 'road', color: 'red' },
                    { type: 'Signalisation', icon: 'traffic-light', color: 'yellow' },
                    { type: 'Éclairage', icon: 'lightbulb', color: 'blue' }
                ];
        
                const reportsContainer = document.getElementById('recentReports');
                
                for (let i = 0; i < 6; i++) {
                    const report = reportTypes[Math.floor(Math.random() * reportTypes.length)];
                    const card = document.createElement('div');
                    card.className = 'report-card bg-white rounded-lg shadow-md overflow-hidden';
                    card.innerHTML = `
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-3">
                                <span class="bg-${report.color}-100 text-${report.color}-600 px-3 py-1 rounded-full text-sm">
                                    ${report.type}
                                </span>
                                <span class="text-gray-500 text-sm">Il y a ${Math.floor(Math.random() * 24)} heures</span>
                            </div>
                            <h3 class="font-bold mb-2">${report.type} signalé</h3>
                            <p class="text-gray-600 text-sm">Rue de Paris, 75001</p>
                        </div>
                        <div class="border-t px-4 py-3 bg-gray-50">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-comment mr-1"></i> ${Math.floor(Math.random() * 5)} commentaires
                                </span>
                                <button class="text-blue-600 hover:text-blue-700">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    reportsContainer.appendChild(card);
                }
            </script>
        </body>
        </html>
        

