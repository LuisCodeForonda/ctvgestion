<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Equipo;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Livewire\Attributes\On; 

new #[Layout('layouts.app')] class extends Component {
    //objeto
    public Equipo $equipo;

    public function mount(Equipo $equipo)
    {
        $this->fill($equipo);
    }

    public function with()
    {
        return [
           'qrcode' => QrCode::size(256)->generate('https://admin.ctvbolivia.com/equipo/'.$this->equipo->slug),
        ];
    }
    
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Equipos > informacion</h1>
    @endslot

    <p>{{ $equipo->descripcion }}</p>
    <div>
        {!! $qrcode !!}
    </div>
</div>
