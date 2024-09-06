<?php

use Livewire\Volt\Component;
use App\Models\Componente;
use App\Models\Equipo;
use App\Models\Marca;

new class extends Component {
    public $equipo;

    //atributos del modelo componentes
    public $descripcion;
    public $observaciones;
    public $modelo;
    public $serie;
    public $cantidad = 1;
    public $estado;
    public $marca_id;
    public $equipo_id;

    //variables
    public $componentes = [];
    public $selectedComponentes = [];
    public $equipoComponentes = [];
    public $filter = '';

    //variables generales
    public $isRegistrar = false;
    public $isAgregar = false;
    public $isExtraer = false;

    public function mount($equipo)
    {
        $this->equipo = $equipo;
    }

    //funciones
    public function openModal($modal)
    {
        $this->componentes = Componente::where('estado', '1')
            ->whereNull('equipo_id')
            ->where('descripcion', 'LIKE', '%' . $this->filter . '%')
            ->get();
        $this->equipoComponentes = Componente::where('equipo_id', $this->equipo->id)
            ->latest()
            ->get();

        if ($modal == 'registrar') {
            $this->isRegistrar = true;
        } elseif ($modal == 'agregar') {
            $this->isAgregar = true;
        } elseif ($modal == 'extraer') {
            $this->isExtraer = true;
        }
    }

    public function closeModal()
    {
        $this->resetValidation();
        $this->reset('selectedComponentes');
        $this->reset('descripcion', 'observaciones', 'modelo', 'serie', 'cantidad', 'estado', 'marca_id', 'equipo_id');
        $this->isRegistrar = false;
        $this->isAgregar = false;
        $this->isExtraer = false;
    }

    //funcion para registrar un nuevo componente

    public function save()
    {
        $this->descripcion = Str::trim($this->descripcion);
        $this->observaciones = Str::trim($this->observaciones);
        $this->modelo = Str::trim($this->modelo);
        $this->serie = Str::trim($this->serie);

        $this->validate([
            'descripcion' => 'required|min:3|max:400',
            'observaciones' => 'max:150',
            'modelo' => 'max:30',
            'serie' => 'max:50|unique:componentes',
            'cantidad' => 'required|numeric|min:1',
            'estado' => 'required|numeric|min:1|max:4',
            'marca_id' => '',
            'equipo_id' => '',
        ]);

        Componente::create([
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observaciones,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'cantidad' => $this->cantidad,
            'estado' => $this->estado,
            'marca_id' => $this->marca_id,
            'equipo_id' => $this->equipo->id,
        ]);

        $this->closeModal();
    }

    //funciones para agregar componentes
    public function addComponente($componenteId)
    {
        $componente = $this->componentes->find($componenteId);
        if ($componente) {
            $this->selectedComponentes[] = $componente;
            $this->componentes = $this->componentes->where('id', '!=', $componenteId);
        }
    }

    public function removeComponente($componenteId)
    {
        $componente = collect($this->selectedComponentes)
            ->where('id', $componenteId)
            ->first();
        if ($componente) {
            $this->componentes[] = $componente;
            $this->selectedComponentes = collect($this->selectedComponentes)
                ->where('id', '!=', $componente->id)
                ->values();
        }
    }

    public function saveComponents()
    {
        foreach ($this->selectedComponentes as $componente) {
            $componente->update(['equipo_id' => $this->equipo->id]);
        }
        $this->closeModal();
    }

    //fuciones para extraer componentes
    public function extractComponente($componenteId)
    {
        $componente = $this->equipoComponentes->find($componenteId);
        if ($componente) {
            $this->selectedComponentes[] = $componente;
            $this->equipoComponentes = $this->equipoComponentes->where('id', '!=', $componenteId);
        }
    }

    public function cancelComponente($componenteId)
    {
        $componente = collect($this->selectedComponentes)
            ->where('id', $componenteId)
            ->first();
        if ($componente) {
            $this->equipoComponentes[] = $componente;
            $this->selectedComponentes = collect($this->selectedComponentes)
                ->where('id', '!=', $componente->id)
                ->values();
        }
    }

    public function destroyComponents()
    {
        foreach ($this->selectedComponentes as $componente) {
            $componente->update(['equipo_id' => null]);
        }
        $this->closeModal();
    }

    public function with()
    {
        return [
            'data' => Componente::where('equipo_id', $this->equipo->id)
                ->latest()
                ->get(),
            'componentes' => $this->componentes,
            'marcas' => Marca::all(),
        ];
    }
}; ?>

<div class="py-2 border-t-2">
    <h1 class="text-xl font-bold mb-2">Componentes del equipo</h1>

    <div class="mt-2">
        @if ($data->isEmpty())
            <div class="text-center mt-4">
                <p class="mb-4">Vaya este equipo no tiene componentes</p>
                <div class="flex items-center justify-center gap-2">
                    <x-primary-button wire:click="openModal('registrar')">Registrar</x-primary-button>
                    <x-primary-button wire:click="openModal('agregar')">Agregar</x-primary-button>
                </div>

            </div>
        @else
            <x-primary-button wire:click="openModal('registrar')">Registrar</x-primary-button>
            <x-primary-button wire:click="openModal('agregar')">Agregar</x-primary-button>
            <x-primary-button wire:click="openModal('extraer')">Extraer</x-primary-button>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-2">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Descripcion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Modelo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Serie
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr wire:key="{{ $item->id }}"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->descripcion }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->modelo }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->serie }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->estado == 1)
                                    Stand by
                                @elseif($item->estado == 2)
                                    Operativo
                                @elseif($item->estado == 3)
                                    Mantenimiento
                                @elseif($item->estado == 4)
                                    Malo
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        @endif
    </div>

    @if ($isRegistrar)
        <x-modal-show title="Registrar un nuevo componente">
            <form wire:submit="save">
                @include('forms.componente-form')
                <div class="flex justify-end gap-2">
                    <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                    <x-primary-button>Guardar</x-primary-button>
                </div>
            </form>
        </x-modal-show>
    @endif

    @if ($isAgregar)
        <x-modal-show title="Agregar componentes" width="2xl">
            <form wire:submit="saveComponents">
                <div class="grid grid-cols-1 gap-2">
                    <div>
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Manifiesto</label>
                        <textarea id="descripcion" wire:model="descripcion" name="descripcion" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agregar</label>
                            <table
                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-2">
                                <tbody>
                                    @foreach ($selectedComponentes as $item)
                                        <tr wire:key="{{ $item->id }}"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $item->descripcion }}
                                            </th>
                                            <td class="py-2 ">
                                                {{ $item->serie }}
                                            </td>
                                            <td class="py-2 ">
                                                <button wire:click.prevent="removeComponente({{ $item->id }})"
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Quitar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <label for="descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Disponibles</label>
                            <table
                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-2">
                                <tbody>
                                    @foreach ($componentes as $item)
                                        <tr wire:key="{{ $item->id }}"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $item->descripcion }}
                                            </th>
                                            <td class="py-2">
                                                {{ $item->serie }}
                                            </td>
                                            <td class="py-2">
                                                <button wire:click.prevent="addComponente({{ $item->id }})"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Instalar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                    <x-primary-button>Guardar</x-primary-button>
                </div>

            </form>
        </x-modal-show>
    @endif

    @if ($isExtraer)
        <x-modal-show title="Extraer componentes" width="2xl">
            <form wire:submit="destroyComponents">
                <div class="grid grid-cols-1 gap-2">
                    <div>
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Manifiesto</label>
                        <textarea id="descripcion" wire:model="descripcion" name="descripcion" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instalados</label>
                            <table
                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-2">
                                <tbody>
                                    @foreach ($equipoComponentes as $item)
                                        <tr wire:key="{{ $item->id }}"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $item->descripcion }}
                                            </th>
                                            <td class="py-2 ">
                                                {{ $item->serie }}
                                            </td>
                                            <td class="py-2 ">
                                                <button wire:click.prevent="extractComponente({{ $item->id }})"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Quitar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <label for="descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Extraer</label>
                            <table
                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-2">
                                <tbody>

                                    @foreach ($selectedComponentes as $item)
                                        <tr wire:key="{{ $item->id }}"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $item->descripcion }}
                                            </th>
                                            <td class="py-2 ">
                                                {{ $item->serie }}
                                            </td>
                                            <td class="py-2 ">
                                                <button wire:click.prevent="cancelComponente({{ $item->id }})"
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Cancelar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                    <x-primary-button>Guardar</x-primary-button>
                </div>

            </form>
        </x-modal-show>
    @endif

</div>
