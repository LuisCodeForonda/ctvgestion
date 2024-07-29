<x-modal-form :name="'Formulario Accion'" :id="$accion_id">
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
            <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
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
</x-modal-form>
