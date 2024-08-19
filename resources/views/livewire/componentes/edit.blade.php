<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Componente;
use Illuminate\Support\Str;

new #[Layout('layouts.app')] class extends Component {
    //objeto
    public Componente $componente;

    //variables del modelo
    public $descripcion;
    public $observaciones;
    public $modelo;
    public $serie;
    public $cantidad = 1;
    public $estado;
    public $marca_id;
    public $equipo_id;

    public function mount(Componente $componente)
    {
        $this->fill($componente);
        $this->descripcion = $componente->descripcion;
        $this->observaciones = $componente->observaciones;
        $this->modelo = $componente->modelo;
        $this->serie = $componente->serie;
        $this->cantidad = $componente->cantidad;
        $this->estado = $componente->estado;
        $this->marca_id = $componente->marca_id;
        $this->equipo_id = $componente->equipo_id;
    }

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
            'serie' => 'max:50',
            'cantidad' => 'required|numeric|min:1',
            'estado' => 'required|numeric|min:1|max:4',
            'marca_id' => '',
            'equipo_id' => '',
        ]);

        $this->componente->update([
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

        return $this->redirect('/componentes', navigate: true);
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Componentes > editar</h1>
    @endslot

    <h1 class="text-center">Formulario</h1>
    <x-layout-form>
        @include('forms.componente-form')

        <div class="flex justify-end gap-2">

            <x-secondary-button href="{{ route('componentes.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
