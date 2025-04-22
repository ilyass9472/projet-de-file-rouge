<nav class="glass-effect sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="group">
                    <span class="text-2xl font-bold text-gradient group-hover:scale-105 transition-transform duration-300 inline-block">
                        {{ config('app.name', 'Laravel') }}
                    </span>
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" 
                           class="px-6 py-2 rounded-lg glass-effect hover:bg-white/10 transition-all duration-300">
                            {{ __('Login') }}
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="px-6 py-2 rounded-lg animated-gradient text-white hover:scale-105 transition-transform duration-300">
                            {{ __('Register') }}
                        </a>
                    @endif
                @else
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center space-x-3 px-4 py-2 rounded-lg glass-effect hover:bg-white/10 transition-all duration-300">
                            <img class="h-8 w-8 rounded-lg object-cover" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=45b7d1&color=ffffff" 
                                 alt="{{ Auth::user()->name }}">
                            <span class="text-white">{{ Auth::user()->name }}</span>
                            <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             class="absolute right-0 mt-2 w-48 rounded-lg glass-effect">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="block px-4 py-2 text-sm text-white hover:bg-white/10 transition-all duration-300 rounded-lg">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>