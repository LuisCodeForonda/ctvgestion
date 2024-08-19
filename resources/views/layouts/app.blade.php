<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="w-full h-screen">
        {{-- <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

        <div class="flex flex-row">
            <div class="box-1 bg-gray-900 text-white min-w-12 w-56 h-screen">

                {{-- logo --}}
                <div class="text-center">
                    <a href="dashboard" wire:navigate class="block text-nowrap py-4 px-1">
                        <img src="{{ asset('images/ctvmosca.png') }}" alt=""
                            class="h-10 w-12 inline-block mr-2">
                        <h1 class="inline-block align-middle text-4xl font-bold">CTV</h1>
                    </a>
                </div>

                {{-- menu de navegacion --}}
                <ul class="relative">
                    <li>
                        <a href="/usuario" wire:navigate>
                            <div
                                class="py-2 flex items-center text-slate-400 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('usuario.index') ? 'text-white bg-slate-300/30' : '' }}">
                                <img src="{{ asset('icons/user.svg') }}" alt="" class="px-4 mr-1">
                                <span>Usuarios</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/rol" wire:navigate>
                            <div
                                class="py-2 flex items-center text-slate-400 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('rol.index') ? 'text-white bg-slate-300/30' : '' }}">
                                <img src="{{ asset('icons/user-detail.svg') }}" alt="" class="px-4 mr-1">
                                <span>Roles</span>
                            </div>
                        </a>
                    </li>
                    <li class="overflow-hidden">
                        <button
                            class="list-button py-2 w-full flex items-center text-slate-400 hover:text-white hover:bg-slate-300/30">
                            <img src="{{ asset('icons/chip.svg') }}" alt="" class="px-4 mr-1">
                            <span class="grow text-left">Equipos</span>
                            <img src="{{ asset('icons/arrow-down.svg') }}" alt="" class="px-4 icon_arrow">
                        </button>
                        <ul class="h-0 pl-10 show_menu">
                            <li class="border-l-2">
                                <a href="{{ route('marcas.index') }}" wire:navigate class="cursor-pointer">
                                    <span
                                        class="block px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('marcas.index') ? 'text-white bg-slate-300/30' : '' }}">Marcas</span>
                                </a>
                            </li>
                            <li class="border-l-2">
                                <a href="{{ route('componentes.index') }}" wire:navigate class="cursor-pointer ">
                                    <span
                                        class="block px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('componente.index') ? 'text-white bg-slate-300/30' : '' }}">Componente</span>
                                </a>
                            </li>
                            <li class="border-l-2">
                                <a href="{{ route('equipos.index') }}" wire:navigate class="cursor-pointer ">
                                    <span
                                        class="block px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('equipo.index') ? 'text-white bg-slate-300/30' : '' }}">Equipos</span>
                                </a>
                            </li>
                           
                            
                            <li class="border-l-2">
                                <a href="{{ route('encargados.index') }}" wire:navigate class="cursor-pointer ">
                                    <span
                                        class="block px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('encargado.index') ? 'text-white bg-slate-300/30' : '' }}">Encargado</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="overflow-hidden">
                        <button
                            class="list-button py-2 w-full flex items-center text-slate-400 hover:text-white hover:bg-slate-300/30">
                            <img src="{{ asset('icons/news.svg') }}" alt="" class="px-4 mr-1">
                            <span class="grow text-left">Noticias</span>
                            <img src="{{ asset('icons/arrow-down.svg') }}" alt="" class="px-4 icon_arrow">
                        </button>
                        <ul class="h-0 pl-10 show_menu">
                            <li class="border-l-2">
                                <a href="/categoria" wire:navigate class="cursor-pointer ">
                                    <span
                                        class="block px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-300/30">Categorias</span>
                                </a>
                            </li>
                            <li class="border-l-2">
                                <a href="/noticia" wire:navigate class="cursor-pointer ">
                                    <span
                                        class="block px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-300/30">Post</span>
                                </a>
                            </li>
                        
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="box-2 w-96 h-screen grow overflow-y-scroll relative">
                <div class="bg-white sticky z-10 p-4 top-0 left-0 flex items-center justify-between border-b-2">
                    <div class="flex">
                        <img src="{{ asset('icons/menu.svg') }}" alt="" class="block cursor-pointer toogle_menu">

                        <h2 class="ml-4">{{ $header }}</h2>
                    </div>
                    
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name"></div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start">
                                    <x-dropdown-link>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

                <!-- Page Content -->
                <main class="relative bg-white p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
    
    @livewireScripts
</body>

</html>
