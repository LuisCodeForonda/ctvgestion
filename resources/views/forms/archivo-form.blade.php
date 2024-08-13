<x-modals :name="'Formulario Archivo'" width="xl">
    <form wire:submit="store" class="p-4 md:p-5">
        <div class="grid gap-4 mb-4">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file">Upload
                    file</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="file" name="file" wire:model="file" type="file" multiple>
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
            </div>
        </div>
        <button type="submit"
            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{ $archivo_id ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
</x-modals>
