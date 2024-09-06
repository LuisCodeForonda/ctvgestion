<?php

use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Marca;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    //variables de pagina
    public $paginate = 10;
    public $search = '';
    public $show = false;
    public $showDelete = false;
    public $marca;

    //ordenar
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    //funciones
    public function view($id)
    {
        $this->marca = Marca::findOrFail($id);
        $this->show = true;
    }

    public function destroy($id)
    {
        $this->marca = Marca::findOrFail($id);
        $this->showDelete = true;
    }

    public function confirmDestroy()
    {
        $this->marca->delete();
        session()->flash('message', 'Eliminado Exitosamente.');
        $this->showDelete = false;
    }

    public function closeModal()
    {
        $this->reset('marca');
        $this->show = false;
        $this->showDelete = false;
    }

    public function setSortBy($sort)
    {
        if ($this->sortBy === $sort) {
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sort;
        $this->sortDir = 'DESC';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function with()
    {
        return [
            'data' => Marca::where('nombre', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->paginate),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Marcas</h1>
    @endslot

    <x-primary-button href="{{ route('marcas.create') }}" wire:navigate>Nuevo</x-primary-button>

    <div class="flex flex-row justify-between items-center py-2">
        <div class="flex items-center w-64 max-w-sm">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.500ms="search" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Buscar..." />
            </div>
        </div>
        <div class="max-w-sm">
            <select id="countries" wire:model.live="paginate"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="10">10 registros</option>
                <option value="25">25 registros</option>
                <option value="50">50 registros</option>
                <option value="100">100 registros</option>
            </select>
        </div>

    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @include('includes.table-sortable', [
                        'name' => 'nombre',
                        'displayName' => 'Nombre',
                    ])
                    @include('includes.table-sortable', [
                        'name' => 'created_at',
                        'displayName' => 'Fecha creacion',
                    ])
                    @include('includes.table-sortable', [
                        'name' => 'updated_at',
                        'displayName' => 'Fecha edicion',
                    ])
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr wire:key="{{ $item->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->nombre }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->updated_at }}
                        </td>
                        <td class="px-6 py-4 flex gap-4">
                            <button wire:click="view({{ $item->id }})"
                                class="font-medium text-yellow-500 dark:text-yellow-500 hover:underline">
                                Show
                            </button>

                            <a href="{{ route('marcas.edit', $item) }}" wire:navigate
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>

                            <button wire:click="destroy({{ $item->id }})"
                                class="font-medium text-red-500 dark:text-red-500 hover:underline">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="py-2">
            {{ $data->links() }}
        </div>
    </div>

    @if ($show)
        <x-modal-show title="Detalle del marca">
            <strong>Nombre</strong>
            <p>{{ $marca->nombre }}</p>
            <strong>Creado</strong>
            <p>{{ $marca->created_at }}</p>
            <strong>Actulizado</strong>
            <p>{{ $marca->updated_at }}</p>
        </x-modal-show>
    @endif

    @if ($showDelete)
        <x-modal-destroy-confirm>
            <p class="mb-4">{{ $marca->nombre }}</p>
        </x-modal-destroy-confirm>
    @endif

</div>
