<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Componente > create') }}
        </h2>
    </x-slot>

   <div class="bg-white p-4">
        <livewire:equipo.create-component />
   </div>
</x-app-layout>
