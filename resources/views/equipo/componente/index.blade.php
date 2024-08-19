<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Componentes') }}
        </h2>
    </x-slot>

    <div class="bg-white p-4">

        
        <a href="{{ route('componente.create') }}" wire:navigate class="inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> crear</a>
        <livewire:equipo.list-component />
    </div>
</x-app-layout>
