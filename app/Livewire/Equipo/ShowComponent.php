<?php

namespace App\Livewire\Equipo;

use App\Models\Accesorio;
use App\Models\Accion;
use App\Models\Equipo;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Livewire\Attributes\On; 


class ShowComponent extends Component
{
    public $equipo;
    public $slug;

    public function mount($equipo = null)
    {
        $this->equipo = $equipo;
    }

    #[On('accion-created')] 
    public function render()
    {
        return view('livewire.equipo.show-component', 
        [
            'qrcode' => QrCode::size(256)->generate('https://admin.ctvbolivia.com/equipo/'.$this->equipo->slug),
            'accesorios' => Accesorio::where('equipo_id', '=', $this->equipo->id)->get()->count(),
            'acciones' => Accion::where('equipo_id', $this->equipo->id)->get()->count(),
        ]);
    }
}
