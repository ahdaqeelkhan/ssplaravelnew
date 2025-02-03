<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>
<nav x-data="{ open: false }" class="bg-gray-900 text-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 font-ebGaramond">
                <a href="{{ route('home') }}" wire:navigate>
                    <!-- <x-application-logo class="h-12 w-auto fill-current text-teal-500" /> -->
                    <!-- <img src="{{ asset('images/infinitimelogo.svg') }}" class="h-12 w-auto fill-white"> -->
                     INFINITIME
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden lg:flex lg:items-center lg:space-x-6">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate class="text-lg font-medium hover:text-teal-500 transition-colors duration-300">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" wire:navigate class="text-lg font-medium hover:text-teal-500 transition-colors duration-300">
                    {{ __('Watches') }}
                </x-nav-link>
                <x-nav-link :href="route('cart.view')" :active="request()->routeIs('cart.view')" wire:navigate class="text-lg font-medium hover:text-teal-500 transition-colors duration-300">
                    {{ __('Cart') }}
                </x-nav-link>
                
                <!-- Manage Link (Only for Admins) -->
                @if (auth()->check() && auth()->user()->role === 'admin')

                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" wire:navigate class="text-lg font-medium hover:text-teal-500 transition-colors duration-300">
                        {{ __('Manage') }}
                    </x-nav-link>
                @endif
            </div>

            <!-- Right Section (Profile + Cart) -->
            <div class="hidden lg:flex lg:items-center lg:space-x-4">
                <!-- Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full bg-gray-800 hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->check() ? auth()->user()->name : 'Guest']) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            <svg class="ml-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Login (Only if user is not authenticated) -->
                        @if (!auth()->check())
                            <x-dropdown-link :href="route('login')" wire:navigate class="text-base font-medium text-gray-700 hover:text-teal-600 transition-colors duration-300">
                                {{ __('Login') }}
                            </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('profile')" wire:navigate class="text-base font-medium text-gray-700 hover:text-teal-600 transition-colors duration-300">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link class="text-base font-medium text-gray-700 hover:text-teal-600 transition-colors duration-300">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate class="block px-4 py-2 text-lg font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition duration-150 ease-in-out">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" wire:navigate class="block px-4 py-2 text-lg font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition duration-150 ease-in-out">
                {{ __('Watches') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart.view')" :active="request()->routeIs('cart.view')" wire:navigate class="block px-4 py-2 text-lg font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition duration-150 ease-in-out">
                {{ __('Cart') }}
            </x-responsive-nav-link>

            <!-- Manage Link (Only for Admins) -->
            @if (auth()->check() && auth()->user()->role === 'admin')

                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" wire:navigate class="block px-4 py-2 text-lg font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition duration-150 ease-in-out">
                    {{ __('Manage') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white" x-data="{{ json_encode(['name' => auth()->check() ? auth()->user()->name : 'Guest']) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-400">{{ auth()->check() ? auth()->user()->email : 'guest@example.com' }}</div>
            </div>
            <div class="mt-3 space-y-1">
                @if (!auth()->check())
                    <x-responsive-nav-link :href="route('login')" wire:navigate class="block px-4 py-2 text-lg font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition duration-150 ease-in-out">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                @endif
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
