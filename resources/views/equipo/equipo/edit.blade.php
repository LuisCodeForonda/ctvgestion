<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipo > edit') }}
        </h2>
    </x-slot>

    <div class="bg-white p-4">
        <livewire:equipo.edit-equipo :equipo="$equipo" />
    </div>
</x-app-layout>
