<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Noticias') }}
        </h2>
    </x-slot>

   <div>
        @livewire('post.noticia-component')
   </div>
</x-app-layout>
