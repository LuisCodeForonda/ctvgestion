<?php

use Livewire\Volt\Component;
use App\Models\Marca;
use App\Models\Encargado;
use App\Models\Equipo;
use Illuminate\Support\Str;

new class extends Component {
    //variables del modelo
    public $equipo_id;
    public $descripcion;
    public $observaciones;
    public $modelo;
    public $serie;
    public $serietec;
    public $estado;
    public $area;
    public $ubicacion;
    public $marca_id;
    public $encargado_id;
    public $equipo;

    public function save()
    {
        $this->validate([
            'descripcion' => 'required|min:3|max:400',
            'observaciones' => 'max:150',
            'modelo' => 'max:30',
            'serie' => 'max:50',
            'serietec' => 'required|max:50|unique:equipos',
            'estado' => 'required|numeric|min:1|max:4',
            'area' => 'max:30',
            'ubicacion' => 'max:50',
            'marca_id' => '',
            'encargado_id' => '',
        ]);

        Equipo::create([
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observaciones,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'serietec' => $this->serietec,
            'estado' => $this->serie,
            'area' => $this->serie,
            'ubicacion' => $this->ubicacion,
            'slug' => Str::slug($this->serietec),
            'marca_id' => $this->marca_id,
            'encargado_id' => $this->encargado_id,
        ]);

        $this->reset('descripcion', 'observaciones', 'modelo', 'serie', 'serietec', 'estado', 'area', 'ubicacion', 'marca_id', 'encargado_id');

        return $this->redirect('/equipo', navigate: true);
    }

    public function with()
    {
        return [
            'marcas' => Marca::all(),
            'encargados' => Encargado::all(),
        ];
    }
}; ?>

<div>
    <h1 class="text-center mb-4 font-semibold">Formulario para crear un nuevo equipo</h1>

    <x-layout-form width="2xl">
        @include('equipo.equipo.form')

        <div class="flex justify-end gap-2">
            <button href="{{ route('equipo.index') }}" wire:navigate
                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Regresar</button>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar</button>
        </div>
    </x-layout-form>
</div>
