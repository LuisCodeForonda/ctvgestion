<?php

namespace App\Livewire\Equipo;

use Livewire\Component;
use App\Models\Persona;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class PersonaComponent extends Component
{
    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $nombre;

    #[Rule('max:15')]
    public $carnet;

    #[Rule('max:30')]
    public $area;

    #[Rule('required|min:3|max:50')]
    public $cargo;

    public $persona = null;
    public $persona_id = null;
    public $isOpen = false;
    public $paginate = 10;
    public $showDeleteModal = false;
    public $search = '';

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->reset('nombre', 'carnet', 'area', 'cargo');
        $this->resetValidation();
    }

    public function openConfirmModal(){
        $this->showDeleteModal = true;
    }

    public function closeConfimModal(){
        $this->showDeleteModal = false;
        $this->reset('persona', 'nombre', 'carnet', 'area', 'cargo');
    }

    public function store(){ 
    
        $this->validate();

        Persona::updateOrCreate(['id' => $this->persona_id], [
            'nombre' => $this->nombre,
            'carnet' => $this->carnet,
            'area' => $this->area,
            'cargo' => $this->cargo,
        ]);

        session()->flash('message',
            $this->persona_id ? 'Persona Actualizada Exitosamente.' : 'Persona Creado Exitosamente.');

        $this->closeModal();
    }

    public function edit($id){
        $persona = Persona::findOrFail($id);
        $this->persona_id = $id;
        $this->nombre = $persona->nombre;
        $this->carnet = $persona->carnet;
        $this->area = $persona->area;
        $this->cargo = $persona->cargo;

        $this->openModal();
    }

    public function destroy($id){
        $this->persona = Persona::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Persona::find($this->persona->id)->delete();
        session()->flash('message', 'Persona Eliminado Exitosamente.');
        $this->closeConfimModal();
    }


    public function render()
    {
        if($this->search){
            $this->resetPage();
            return view('livewire.equipo.persona-component', ['personas' => Persona::where('nombre', 'LIKE', '%'.$this->search.'%')->paginate($this->paginate)]);
        }

        return view('livewire.equipo.persona-component', ['personas' => Persona::latest()->paginate($this->paginate)]);
    }
}
