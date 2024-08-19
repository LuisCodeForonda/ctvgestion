<?php

use Livewire\Volt\Component;
use App\Models\Componente;
use App\Models\Marca;

new class extends Component {
    //variables del modelo
    public $descripcion;
    public $observaciones;
    public $modelo;
    public $serie;
    public $cantidad = 1;
    public $estado;
    public $marca_id;
    public $equipo_id;

    public function save()
    {
        $this->validate([
            'descripcion' => 'required|min:3|max:400',
            'observaciones' => 'max:150',
            'modelo' => 'max:30',
            'serie' => 'required|max:50|unique:componentes',
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
            'equipo_id' => $this->equipo_id,
        ]);

        $this->reset('descripcion', 'observaciones', 'modelo', 'serie', 'cantidad', 'estado', 'marca_id', 'equipo_id');

        return $this->redirect('/componente', navigate: true);
    }

    public function with()
    {
        return [
            'marcas' => Marca::all(),
        ];
    }
}; ?>

<div>
    <h1 class="text-center mb-4 font-semibold">Formulario para crear un nuevo componente</h1>

    <x-layout-form>
        @include('equipo.componente.form')

        <div class="flex justify-end gap-2">
            <button href="{{ route('componente.index') }}" wire:navigate class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Regresar</button>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar</button>
        </div>
    </x-layout-form>
</div>
