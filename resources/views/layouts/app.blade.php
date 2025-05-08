<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <style>
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes aurora {
            0% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(10px, -10px) scale(1.02); }
            50% { transform: translate(0, 0) scale(1); }
            75% { transform: translate(-10px, 10px) scale(0.98); }
            100% { transform: translate(0, 0) scale(1); }
        }

        .animate-aurora {
            animation: aurora 15s ease infinite;
        }

        .bg-mesh {
            background-image: 
                radial-gradient(at 40% 20%, hsla(328, 100%, 74%, 0.2) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189, 100%, 56%, 0.2) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(355, 100%, 93%, 0.2) 0px, transparent 50%),
                radial-gradient(at 80% 50%, hsla(340, 100%, 76%, 0.2) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(269, 100%, 77%, 0.2) 0px, transparent 50%),
                radial-gradient(at 80% 100%, hsla(300, 100%, 60%, 0.2) 0px, transparent 50%),
                radial-gradient(at 0% 0%, hsla(343, 100%, 76%, 0.2) 0px, transparent 50%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .animated-gradient {
            background: linear-gradient(
                45deg, 
                #ff6b6b,
                #4ecdc4,
                #45b7d1,
                #96c93d,
                #ff6b6b
            );
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }

        .text-gradient {
            background: linear-gradient(to right, #ff6b6b, #4ecdc4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>

<body class="">
    <header>
         
    </header>
   
    <div class="fixed inset-0 bg-mesh animate-aurora"></div>
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -left-40 w-80 h-80 bg-purple-500/30 rounded-full blur-3xl animate-aurora"></div>
        <div class="absolute top-1/3 -right-20 w-60 h-60 bg-blue-500/30 rounded-full blur-3xl animate-aurora" style="animation-delay: -2s;"></div>
        <div class="absolute -bottom-40 left-1/3 w-72 h-72 bg-pink-500/30 rounded-full blur-3xl animate-aurora" style="animation-delay: -4s;"></div>
    </div>
    <div class="relative min-h-full z-10">
                @yield('content')
    </div>
</body>
</html>
