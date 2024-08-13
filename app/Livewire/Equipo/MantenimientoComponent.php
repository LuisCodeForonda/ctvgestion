<?php

namespace App\Livewire\Equipo;

use App\Models\Mantenimiento;
use Livewire\Component;

class MantenimientoComponent extends Component
{

    //variables del modelo
    public $mantenimiento_id;
    public $tipo;
    public $descripcion;
    public $equipo_id;
    public $user_id;
    public $mantenimiento;

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
        $this->reset('tipo','descripcion', 'equipo_id', 'user_id');
        $this->resetValidation();
    }

    public function openConfirmModal()
    {
        $this->showDeleteModal = true;
    }

    public function closeConfimModal()
    {
        $this->showDeleteModal = false;
        $this->reset('mantenimiento_id','tipo','descripcion', 'equipo_id', 'user_id', 'mantenimiento');
    }

    //fuciones para el crud del modelo
    public function store()
    {

        $this->validate([
            'tipo' => 'max:1',
            'descripcion' => 'required|min:3|max:400',
            'equipo_id' => '',
            'user_id' => '',
        ]);

        Mantenimiento::updateOrCreate(['id' => $this->mantenimiento_id], [
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
            'equipo_id' => $this->equipo_id,
            'user_id' => $this->user_id,
        ]);


        session()->flash(
            'message',
            $this->mantenimiento_id ? 'Actualizado Exitosamente.' : 'Creado Exitosamente.'
        );

        $this->closeModal();
    }

    public function edit($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $this->mantenimiento_id = $id;
        $this->tipo = $mantenimiento->tipo;
        $this->descripcion = $mantenimiento->descripcion;
        $this->user_id = $mantenimiento->user_id;
        $this->equipo_id = $mantenimiento->equipo_id;

        $this->openModal();
    }

    public function destroy($id)
    {
        $this->mantenimiento = Mantenimiento::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Mantenimiento::find($this->componente->id)->delete();
        session()->flash('message', 'Eliminado Exitosamente.');
        $this->closeConfimModal();
    }

    public function render()
    {
        return view('livewire.equipo.mantenimiento-component');
    }
}
