<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - {{ $user->nom }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">User Profile</h1>
                    <a href="#" onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-print mr-2"></i> Print
                    </a>
                </div>
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/2 mb-8 md:mb-0">
                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-gray-700 mb-2">Personal Information</h2>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-sm font-medium text-gray-500">Name:</div>
                                    <div class="text-sm text-gray-900">{{ $user->nom }} {{ $user->prenom }}</div>
                                    
                                    <div class="text-sm font-medium text-gray-500">Email:</div>
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    
                                    <div class="text-sm font-medium text-gray-500">Role:</div>
                                    <div class="text-sm text-gray-900">
                                        {{ $user->role_id == 1 ? 'Administrator' : ($user->role_id == 2 ? 'User' : ($user->role_id == 3 ? 'Lawyer' : 'N/A')) }}
                                    </div>
                                    
                                    <div class="text-sm font-medium text-gray-500">Status:</div>
                                    <div class="text-sm">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 
                                               ($user->status == 'inactive' ? 'bg-gray-100 text-gray-800' : 
                                               ($user->status == 'banned' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                            {{ $user->status ?? 'active' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="md:w-1/2 md:pl-8">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">User QR Code</h2>
                        <div class="flex flex-col items-center">
                            <div class="p-1 border border-gray-200 rounded-lg bg-white mb-4">
                                <img src="{{ $qrCodeUrl }}" alt="User QR Code" class="w-64 h-64">
                            </div>
                            <p class="text-sm text-gray-500 text-center">Scan this QR code to access user credentials</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>