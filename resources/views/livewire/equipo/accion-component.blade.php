<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="m-2 p-4 rounded-md border shadow-md">
        <h2 class="text-xl font-bold">Acciones del equipo</h2>
        @if ($isOpen)
            <x-modals :name="'Formulario Accion'">
                <form wire:submit="store" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                            <textarea id="descripcion" wire:model="descripcion" name="descripcion" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>
                        <div>
                            <label for="estado"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                            <select id="estado" wire:model="estado" name="estado"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Selecciona un opcion</option>
                                <option value="1" @selected($estado == 1)>Operativo</option>
                                <option value="2" @selected($estado == 2)>Mantenimiento</option>
                                <option value="3" @selected($estado == 3)>Stand By</option>
                                <option value="4" @selected($estado == 4)>Malo</option>
                            </select>
                            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                        </div>

                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ $accion_id ? 'Actualizar' : 'Guardar' }}
                    </button>
                </form>
            </x-modals>
        @endif

        @if ($showDeleteModal)
            <x-modal-confirm>
                {{ $accion->descripcion }}
            </x-modal-confirm>
        @endif

        <div class="flex justify-between items-center py-2">
            <button type="button" wire:click="openModal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Nuevo</button>
    
            <div class="flex gap-2 justify-end">
                <div class="relative w-96">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.1000ms="search" id="simple-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search branch name..." required />
                </div>
    
                <select id="countries" wire:model.live="paginate"
                    class="w-28 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="10">10 regitros</option>
                    <option value="25">25 regitros</option>
                    <option value="50">50 regitros</option>
                    <option value="100">100 regitros</option>
                </select>
    
                <a href="{{ route('marca.pdf') }}"
                    class="inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generar
                    PDF</a>
            </div>
        </div>
    
        @if (count($acciones))
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Descripcion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Usuario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($acciones as $accion)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ Str::limit($accion->descripcion, 50) }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($accion->estado == 1)
                                    <p class="text-green-600">Operativo</p>
                                @endif
                                @if ($accion->estado == 2)
                                    <p class="text-yellow-600">Mantenimiento</p>
                                @endif
                                @if ($accion->estado == 3)
                                    <p class="text-blue-600">Stand-by</p>
                                @endif
                                @if ($accion->estado == 4)
                                    <p class="text-red-600">Malo</p>
                                @endif
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $accion->usuarios->name }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ date('d-M-Y', strtotime($accion->created_at)) }}
                            </th>
                            <td class="px-6 py-4 flex gap-4">
                                <button wire:click="edit({{ $accion->id }})"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</button>
                                <button wire:click="destroy({{ $accion->id }})"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="p-4 text-center">Vaya al parecer el equipo no tiene acciones</p>
        @endif
    </div>
</div>
