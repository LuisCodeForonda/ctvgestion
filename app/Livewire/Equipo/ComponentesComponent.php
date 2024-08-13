<?php

namespace App\Livewire\Equipo;

use App\Models\Componente;
use App\Models\Equipo;
use App\Models\Marca;
use Livewire\Component;

class ComponentesComponent extends Component
{

    //variable del equipo
    public $equipo;

    //variables del modelo
    public $componente_id;
    public $descripcion;
    public $observaciones;
    public $modelo;
    public $serie;
    public $cantidad;
    public $estado;
    public $marca_id;
    public $equipo_id;
    public $componente;

    //variables generales
    public $isOpen = false;
    public $paginate = 10;
    public $showDeleteModal = false;
    public $search = '';

    //funciones de los modales
    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset('descripcion', 'observaciones', 'modelo', 'serie', 'cantidad', 'estado', 'marca_id', 'equipo_id');
        $this->resetValidation();
    }

    public function openConfirmModal()
    {
        $this->showDeleteModal = true;
    }

    public function closeConfimModal()
    {
        $this->showDeleteModal = false;
        $this->reset('componente_id', 'descripcion', 'observaciones', 'modelo', 'serie', 'cantidad', 'estado', 'marca_id', 'equipo_id', 'componente');
    }

    public function store()
    {

        $this->validate([
            'descripcion' => 'required|min:3|max:400',
            'observaciones' => 'max:150',
            'modelo' => 'max:30',
            'serie' => 'max:50',
            'cantidad' => 'numeric',
            'estado' => 'numeric|min:1|max:4',
            'marca_id' => '',
            'equipo_id' => '',
        ]);



        Componente::updateOrCreate(['id' => $this->componente_id], [
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observaciones,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'cantidad' => $this->cantidad,
            'estado' => $this->estado,
            'marca_id' => $this->marca_id,
            'equipo_id' => $this->equipo->id,
        ]);


        session()->flash(
            'message',
            $this->componente_id ? 'Actualizado Exitosamente.' : 'Creado Exitosamente.'
        );

        $this->closeModal();
    }

    public function edit($id)
    {
        $componente = Componente::findOrFail($id);
        $this->componente_id = $id;
        $this->descripcion = $componente->descripcion;
        $this->observaciones = $componente->observaciones;
        $this->modelo = $componente->modelo;
        $this->serie = $componente->serie;
        $this->cantidad = $componente->cantidad;
        $this->estado = $componente->estado;
        $this->marca_id = $componente->marca_id;
        $this->equipo_id = $componente->equipo_id;

        $this->openModal();
    }

    public function destroy($id)
    {
        $this->componente = Componente::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Componente::find($this->componente->id)->delete();
        session()->flash('message', 'Eliminado Exitosamente.');
        $this->closeConfimModal();
    }


    public function render()
    {
        return view('livewire.equipo.componentes-component', ['componentes' => Componente::where('equipo_id', $this->equipo->id)->latest()->paginate($this->paginate), 'equipos' => Equipo::all(), 'marcas' => Marca::all()]);
    }
}
