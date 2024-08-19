<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipo > create') }}
        </h2>
    </x-slot>

   <div class="bg-white p-4">
        <livewire:equipo.create-equipo />
   </div>
</x-app-layout>
