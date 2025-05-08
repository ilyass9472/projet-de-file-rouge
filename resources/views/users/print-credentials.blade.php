<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print User Credentials - {{ $user->nom }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }
            .no-print {
                display: none;
            }
            .print-container {
                width: 100%;
                max-width: 100%;
                padding: 0;
                margin: 0;
                box-shadow: none;
            }
            .print-page {
                page-break-after: always;
                padding: 20px;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-8 print-container">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden print-page">
            <div class="p-6">
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">User Credentials</h1>
                    <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded no-print">
                        Print Credentials
                    </button>
                </div>
                
                <div class="flex flex-col items-center mb-8">
                    <div class="p-1 border border-gray-200 rounded-lg bg-white mb-4">
                        <img src="{{ $qrCodeUrl }}" alt="User QR Code" class="w-64 h-64">
                    </div>
                    
                    <div class="text-center">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $user->nom }} {{ $user->prenom }}</h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <p class="text-gray-500 text-sm mt-2">Scan this QR code to access your account</p>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-6">
                    <div class="text-center">
                        <p class="text-sm text-gray-500 mb-1">This QR code contains your login credentials.</p>
                        <p class="text-sm text-gray-500 mb-1">Keep it safe and do not share with others.</p>
                        <p class="text-sm text-gray-500">For assistance, please contact the administrator.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>