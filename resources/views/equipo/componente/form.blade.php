<div class="grid gap-6 mb-6 grid-cols-1">
    <div>
        <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
            descripcion</label>
        <textarea wire:model="descripcion" id="descripcion" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Write your thoughts here..."></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>
    <div>
        <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
            observaciones</label>
        <textarea wire:model="observaciones" id="observaciones" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Write your thoughts here..."></textarea>
    </div>
    <div>
        <label for="modelo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">modelo</label>
        <input type="text" wire:model="modelo" id="modelo"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
    </div>
    <div>
        <label for="serie" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">serie</label>
        <input type="text" wire:model="serie" id="serie"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('serie')" class="mt-2" />
    </div>
    <div>
        <label for="cantidad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cantidad:</label>
        <input type="number" wire:model="cantidad" id="cantidad" aria-describedby="helper-text-explanation"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
    </div>
    <div>
        <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
        <select id="estado" wire:model="estado" name="estado"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Selecciona un opcion</option>
            <option value="1" @selected($estado == 1)>Stand by</option>
            <option value="2" @selected($estado == 2)>Operativo</option>
            <option value="3" @selected($estado == 3)>Mantenimiento</option>
            <option value="4" @selected($estado == 4)>Malo</option>
        </select>
        <x-input-error :messages="$errors->get('estado')" class="mt-2" />
    </div>
</div>
