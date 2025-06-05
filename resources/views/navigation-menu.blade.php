<nav x-data="{ open: false }" class="bg-gradient-to-r from-[#0f172a] to-[#4c1d95] border-b border-[#1e293b] text-white shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side: Logo & Navigation Links -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="Belikan Logo" 
                             class="h-10 w-auto">
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden sm:flex sm:space-x-8 sm:ml-10">
                    <x-nav-link href="{{ route('jenis.index') }}" 
                               :active="request()->routeIs('jenis.index')" 
                               class="text-white hover:text-yellow-400 transition-colors duration-200 font-medium">
                        {{ __('JENIS') }}
                    </x-nav-link>
                    
                    <x-nav-link href="{{ route('aquarium.index') }}" 
                               :active="request()->routeIs('aquarium.index')" 
                               class="text-white hover:text-yellow-400 transition-colors duration-200 font-medium">
                        {{ __('AQUARIUM') }}
                    </x-nav-link>
                    
                    <x-nav-link href="{{ route('perawatan.index') }}" 
                               :active="request()->routeIs('perawatan.index')" 
                               class="text-white hover:text-yellow-400 transition-colors duration-200 font-medium">
                        {{ __('PERAWATAN') }}
                    </x-nav-link>
                    
                    <x-nav-link href="{{ route('aksesoris.index') }}" 
                               :active="request()->routeIs('aksesoris.index')" 
                               class="text-white hover:text-yellow-400 transition-colors duration-200 font-medium">
                        {{ __('AKSESORIS') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side: Search, Cart, Profile -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <!-- Search Form -->
                <div class="relative">
                    <form class="flex items-center">
                        <div class="relative">
                            <input type="text" 
                                   name="cari" 
                                   class="bg-white/10 backdrop-blur-sm border border-white/30 rounded-full px-4 py-2 pl-10 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:bg-white/20 transition-all duration-200 w-48">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-white/70" 
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"> <!-- placeholder="Cari produk..."  -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- Shopping Cart -->
                <div class="relative">
                    <a href="{{ route('cart.index') }}" 
                    class="inline-flex items-center p-2 rounded-full text-white hover:text-yellow-400 hover:bg-white/10 transition-all duration-200"
                    title="Keranjang Belanja">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor" 
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0L17 18H9"/>
                        </svg>
                        <!-- Cart Badge -->
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- User Profile Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex items-center text-sm rounded-full border-2 border-white/30 hover:border-yellow-400 focus:outline-none focus:border-yellow-400 transition-colors duration-200">
                                    <img class="h-9 w-9 rounded-full object-cover" 
                                         src="{{ Auth::user()->profile_photo_url }}" 
                                         alt="{{ Auth::user()->name }}">
                                </button>
                            @else
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm rounded-lg text-white hover:text-yellow-400 hover:bg-white/10 transition-all duration-200">
                                    <span class="font-medium">{{ Auth::user()->name }}</span>
                                    <svg class="ml-2 w-4 h-4 transition-transform duration-200" 
                                         xmlns="http://www.w3.org/2000/svg" 
                                         fill="none" 
                                         viewBox="0 0 24 24" 
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                    </svg>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Profile Dropdown Content -->
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}" class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ __('Profile') }}</span>
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}" class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2m-2-2v6a2 2 0 01-2 2h-4a2 2 0 01-2-2V9a2 2 0 012-2h4zm-6 2v6"/>
                                    </svg>
                                    <span>{{ __('API Tokens') }}</span>
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}" 
                                                   @click.prevent="$root.submit();"
                                                   class="flex items-center space-x-2 text-red-600 hover:bg-red-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        <span>{{ __('Log Out') }}</span>
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Mobile Hamburger Menu -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" 
                        class="p-2 text-white rounded-lg hover:bg-white/10 focus:outline-none focus:bg-white/20 transition-colors duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" 
                              class="inline-flex" 
                              stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" 
                              class="hidden" 
                              stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-gradient-to-r from-[#0f172a] to-[#4c1d95]">
        <!-- Mobile Navigation Links -->
        <div class="px-2 pt-2 pb-3 space-y-1 border-t border-white/10">
            <x-responsive-nav-link href="{{ route('jenis.index') }}" 
                                 :active="request()->routeIs('jenis.index')" 
                                 class="text-white hover:text-yellow-400 hover:bg-white/10">
                {{ __('JENIS') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('aquarium.index') }}" 
                                 :active="request()->routeIs('aquarium.index')" 
                                 class="text-white hover:text-yellow-400 hover:bg-white/10">
                {{ __('AQUARIUM') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('perawatan.index') }}" 
                                 :active="request()->routeIs('perawatan.index')" 
                                 class="text-white hover:text-yellow-400 hover:bg-white/10">
                {{ __('PERAWATAN') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('aksesoris.index') }}" 
                                 :active="request()->routeIs('aksesoris.index')" 
                                 class="text-white hover:text-yellow-400 hover:bg-white/10">
                {{ __('AKSESORIS') }}
            </x-responsive-nav-link>

            <!-- Mobile Search -->
            <div class="px-3 py-2">
                <form class="flex items-center">
                    <input type="text" 
                           name="cari" 
                           placeholder="Cari produk..." 
                           class="w-full bg-white/10 backdrop-blur-sm border border-white/30 rounded-lg px-4 py-2 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </form>
            </div>

            <!-- Mobile Cart Link -->
            <x-responsive-nav-link href="{{ route('cart.index') }}" 
                                 class="text-white hover:text-yellow-400 hover:bg-white/10 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0L17 18H9"/>
                </svg>
                <span>{{ __('Keranjang Belanja') }}</span>
            </x-responsive-nav-link>
        </div>

        <!-- Mobile User Profile Section -->
        <div class="pt-4 pb-1 border-t border-white/10">
            <div class="flex items-center px-4 mb-3">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover border-2 border-white/30" 
                             src="{{ Auth::user()->profile_photo_url }}" 
                             alt="{{ Auth::user()->name }}">
                    </div>
                @endif
                <div>
                    <div class="font-medium text-white text-base">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-purple-200">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}" 
                                     :active="request()->routeIs('profile.show')" 
                                     class="text-white hover:text-yellow-400 hover:bg-white/10">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" 
                                         :active="request()->routeIs('api-tokens.index')" 
                                         class="text-white hover:text-yellow-400 hover:bg-white/10">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" 
                                         @click.prevent="$root.submit();" 
                                         class="text-red-300 hover:text-red-100 hover:bg-red-600/20">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>