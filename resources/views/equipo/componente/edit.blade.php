<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Componente > edit') }}
        </h2>
    </x-slot>

    <div class="bg-white p-4">
        <livewire:equipo.edit-component :componente="$componente" />
    </div>
</x-app-layout>
