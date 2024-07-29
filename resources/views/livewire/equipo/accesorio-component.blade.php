<div>
    {{-- Be like water. --}}
    <div class="m-2 p-4 rounded-md border shadow-md">

        @if ($isOpen)
            @include('forms.accesorio-form')
        @endif

        @if ($showDeleteModal)
            <x-modal-confirm>
                {{ $accesorio->descripcion }}
            </x-modal-confirm>
        @endif

        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">Accesorios del equipo</h2>
            <button type="button" wire:click="openModal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Nuevo</button>
        </div>

        @if (count($accesorios))
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Descripcion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Marca
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Modelo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Serie
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accesorios as $accesorio)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ Str::limit($accesorio->descripcion, 40) }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $accesorio->marca ? $accesorio->marca->nombre : 'sin marca' }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $accesorio->modelo }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $accesorio->serie }}
                                </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $accesorio->cantidad }}
                                </td>
                            <td class="px-6 py-4 flex gap-4">
                                <button wire:click="edit({{ $accesorio->id }})"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</button>
                                <button wire:click="destroy({{ $accesorio->id }})"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                                {{-- <a href="{{ route('accesorio.edit', ['accesorio'=>$accesorio->id, 'equipo'=>$equipo->slug]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                            <form action="{{ route('accesorio.destroy', $accesorio->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="slug" value="{{ $equipo->slug }}">
                                <input type="submit" value="Eliminar" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                            </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center py-4">Vaya al parecer el equipo no tiene accesorios</p>
        @endif
    </div>
</div>
