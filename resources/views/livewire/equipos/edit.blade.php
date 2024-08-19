<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Encargado;
use Illuminate\Support\Str;

new #[Layout('layouts.app')] class extends Component {
    //objeto
    public Equipo $equipo;

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

    public function mount(Equipo $equipo)
    {
        $this->fill($equipo);
        $this->descripcion = $equipo->descripcion;
        $this->observaciones = $equipo->observaciones;
        $this->modelo = $equipo->modelo;
        $this->serie = $equipo->serie;
        $this->cantidad = $equipo->cantidad;
        $this->estado = $equipo->estado;
        $this->area = $equipo->area;
        $this->ubicacion = $equipo->ubicacion;
        $this->marca_id = $equipo->marca_id;
        $this->equipo_id = $equipo->equipo_id;
    }

    public function save()
    {
        $this->descripcion = Str::trim($this->descripcion);
        $this->observaciones = Str::trim($this->observaciones);
        $this->modelo = Str::trim($this->modelo);
        $this->serie = Str::trim($this->serie);
        $this->serietec = Str::trim($this->serietec);
        $this->area = Str::trim($this->area);
        $this->ubicacion = Str::trim($this->ubicacion);

        $this->validate([
            'descripcion' => 'required|min:3|max:400',
            'observaciones' => 'max:150',
            'modelo' => 'max:30',
            'serie' => 'max:50',
            'estado' => 'required|numeric|min:1|max:4',
            'area' => '',
            'ubicacion' => '',
            'marca_id' => '',
            'encargado_id' => '',
        ]);

        $this->equipo->update([
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observaciones,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'estado' => $this->estado,
            'area' => $this->area,
            'ubicacion' => $this->ubicacion,
            'marca_id' => $this->marca_id,
            'encargado_id' => $this->encargado_id,
        ]);

        $this->reset('descripcion', 'observaciones', 'modelo', 'serie', 'serietec', 'estado', 'area', 'ubicacion', 'marca_id', 'encargado_id');

        return $this->redirect('/equipos', navigate: true);
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
    @slot('header')
        <h1 class="font-bold">Equipos > editar</h1>
    @endslot

    <h1 class="text-center">Formulario</h1>
    <x-layout-form>
        @include('forms.equipo-form')

        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('equipos.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Actualizar</x-primary-button>
        </div>
    </x-layout-form>
</div>
