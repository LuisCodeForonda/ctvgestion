<x-modals :name="('Formulario Personas')" width="xl">
    <form wire:submit="store" class="p-4 md:p-5">
        <div class="grid gap-4 mb-4">
            <div>
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input type="text" name="nombre" wire:model="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="carnet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Carnet</label>
                    <input type="text" name="carnet" wire:model="carnet" id="carnet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    <x-input-error :messages="$errors->get('carnet')" class="mt-2" />
                </div>
                <div>
                    <label for="area" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Area</label>
                    <input type="text" name="area" wire:model="area" id="area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    <x-input-error :messages="$errors->get('area')" class="mt-2" />
                </div>
            </div>
            <div>
                <label for="cargo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
                <input type="text" name="cargo" wire:model="cargo" id="cargo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <x-input-error :messages="$errors->get('cargo')" class="mt-2" />
            </div>
        </div>
        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{ $persona_id? 'Actualizar':'Guardar'}}
        </button>
    </form>
</x-modals>