<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="mx-4 border-t-2">
    </div>
    <div class="p-2">

        @if ($isOpen)
            @include('forms.archivo-form')
        @endif


        @if ($showDeleteModal)
            <x-modal-confirm>
                {{ $archivo->nombre }}
            </x-modal-confirm>
        @endif

        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">Archivos del equipo</h2>
            <button type="button" wire:click="openModal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Nuevo</button>
        </div>


        <div class="mt-2">
            <ul class="grid grid-cols-4 gap-2">
                @foreach ($archivos as $archivo)
                    <li
                        class="relative h-32 border-2 shadow-md p-2 rounded-md flex flex-col justify-between items-center ">
                        <a href=" {{ Storage::url($archivo->file) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $archivo->nombre }}</a>
                        <span class="text-4xl">{{ $archivo->extension }}</span>
                        <div class="flex gap-2">
                            <button type="button" wire:click="download('{{ $archivo->file }}', '{{ $archivo->nombre }}')"><img
                                    src="{{ asset('icons/download.svg') }}" alt=""
                                    class="hover:bg-blue-500 p-1 rounded-sm"></button>
                            <button type="button" wire:click="destroy({{ $archivo->id }})"><img src="{{ asset('icons/trash.svg') }}"
                                    alt="" class="hover:bg-red-500 p-1 rounded-sm"></button>
                        </div>

                    </li>
                @endforeach
            </ul>

        </div>

    </div>
</div>
