<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles y permisos') }}
        </h2>
    </x-slot>

   <div class="">
        @livewire('user.rol-component')
   </div>
</x-app-layout>
