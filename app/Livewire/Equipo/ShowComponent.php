<?php

namespace App\Livewire\Equipo;

use App\Models\Equipo;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Livewire\Attributes\On; 


class ShowComponent extends Component
{
    public $equipo;
    public $slug;
    public $accesorios = 0;
    public $acciones = 0;

    public function mount($equipo = null)
    {
        $this->equipo = $equipo;
    }

    #[On('accion-created')] 
    public function render()
    {
        return view('livewire.equipo.show-component', ['qrcode' => QrCode::size(256)->generate('https://admin.ctvbolivia.com/equipo/'.$this->equipo->slug)]);
    }
}
