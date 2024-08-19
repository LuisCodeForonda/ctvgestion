<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Encargado;
use Illuminate\Support\Str;

new #[Layout('layouts.app')] class extends Component {
    //variables del modelo
    public $nombre;
    public $cargo;
    public $carnet;
    public $celular;

    public function save()
    {
        $this->nombre = Str::trim($this->nombre);
        $this->cargo = Str::trim($this->cargo);
        $this->carnet = Str::trim($this->carnet);
        $this->celular = Str::trim($this->celular);

        $this->validate([
            'nombre' => 'required|max:30',
            'cargo' => 'required|max:30',
            'carnet' => 'max:15',
            'celular' => 'required|max:15',
        ]);

        Encargado::create([
            'nombre' => $this->nombre,
            'cargo' => $this->cargo,
            'carnet' => $this->carnet,
            'celular' => $this->celular,
        ]);

        $this->reset('nombre', 'cargo', 'carnet', 'celular');

        return $this->redirect('/encargados', navigate: true);
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Encargados > crear</h1>
    @endslot

    <h1 class="text-center">Formulario</h1>
    <x-layout-form>
        @include('forms.encargado-form')

        <div class="flex justify-end gap-2">
            
            <x-secondary-button href="{{ route('encargados.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
