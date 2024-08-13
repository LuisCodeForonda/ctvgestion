<?php

namespace App\Livewire\Equipo;

use Livewire\Component;
use App\Models\Encargado;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class EncargadoComponent extends Component
{

    public $encargado_id;
    public $nombre;
    public $cargo;
    public $carnet;
    public $celular;
    public $encargado;
    
    //atributos generales
    public $isOpen = false;
    public $paginate = 10;
    public $showDeleteModal = false;
    public $search = '';

    //funciones de los modales
    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->reset('nombre', 'cargo', 'carnet', 'celular');
        $this->resetValidation();
    }

    public function openConfirmModal(){
        $this->showDeleteModal = true;
    }

    public function closeConfimModal(){
        $this->showDeleteModal = false;
        $this->reset('encargado', 'nombre', 'cargo', 'carnet', 'celular');
    }

    
    public function store(){ 
    
        $this->validate([
            'nombre' => 'required|max:30',
            'cargo' => 'required|max:30',
            'carnet' => 'max:15',
            'celular' => 'required|max:15',
        ]);

        Encargado::updateOrCreate(['id' => $this->encargado_id], [
            'nombre' => $this->nombre,
            'cargo' => $this->cargo,
            'carnet' => $this->carnet,
            'celular' => $this->celular,
        ]);

        session()->flash('message',
            $this->encargado_id ? 'Actualizada Exitosamente.' : 'Creado Exitosamente.');

        $this->closeModal();
    }

    public function edit($id){
        $persona = Encargado::findOrFail($id);
        $this->encargado_id = $id;
        $this->nombre = $persona->nombre;
        $this->cargo = $persona->cargo;
        $this->carnet = $persona->carnet;
        $this->celular = $persona->celular;

        $this->openModal();
    }

    public function destroy($id){
        $this->encargado = Encargado::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Encargado::find($this->encargado->id)->delete();
        session()->flash('status', 'Task was successful!');
        $this->closeConfimModal();
    }

    public function render()
    {
        if($this->search){
            $this->resetPage();
            return view('livewire.equipo.encargado-component', ['encargados' => Encargado::where('nombre', 'LIKE', '%'.$this->search.'%')->paginate($this->paginate)]);
        }

        return view('livewire.equipo.encargado-component', ['encargados' => Encargado::latest()->paginate($this->paginate)]);
    }
}
