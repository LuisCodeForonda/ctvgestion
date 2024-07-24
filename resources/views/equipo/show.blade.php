<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipos') }}
        </h2>
    </x-slot>

   <div class="p-4 grid grid-cols-1 gap-2">
        @livewire('equipo.show-component', ['equipo' => $equipo])
        @livewire('equipo.accesorio-component', ['equipo' => $equipo])
        @livewire('equipo.accion-component', ['equipo' => $equipo])
   </div>
</x-app-layout>
