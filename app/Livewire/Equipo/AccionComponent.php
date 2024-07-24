<?php

namespace App\Livewire\Equipo;

use Livewire\Component;
use App\Models\Accion;
use App\Models\Equipo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;


class AccionComponent extends Component
{

    use WithPagination;

    public $slug;

    public $accion_id;

    #[Rule('')]
    public $equipo_id;

    #[Rule('')]
    public $user_id;

    #[Rule('required|max:300')]
    public $descripcion;

    #[Rule('required|max:30')]
    public $estado;
    
    public $accion = null;
    public $isOpen = false;
    public $paginate = 10;
    public $showDeleteModal = false;
    public $search = '';
    public $equipo;

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->reset('accion_id', 'equipo_id', 'user_id', 'descripcion', 'estado');
        $this->resetValidation();
    }

    public function openConfirmModal(){
        $this->showDeleteModal = true;
    }

    public function closeConfimModal(){
        $this->showDeleteModal = false;
        $this->reset('accion', 'equipo_id', 'accion_id', 'user_id', 'descripcion', 'estado');
    }

    public function store(){ 
    
        $this->validate();

        Accion::updateOrCreate(['id' => $this->accion_id], [
            'equipo_id' => $this->equipo->id,
            'user_id' => Auth::user()->id,
            'descripcion' => $this->descripcion,
            'estado' => $this->estado,
        ]);

        $this->equipo->update([
            'estado' => $this->estado,
        ]);
        
        session()->flash('message',
            $this->accion_id ? 'Accion Actualizada Exitosamente.' : 'Accion Creado Exitosamente.');

        $this->closeModal();

        $this->dispatch('accion-created'); 
    }

    public function edit($id){
        $accion = Accion::findOrFail($id);
        $this->accion_id = $id;
        $this->equipo_id = $accion->equipo_id;
        $this->user_id = $accion->user_id;
        $this->descripcion = $accion->descripcion;
        $this->estado = $accion->estado;
        $this->openModal();
    }

    public function destroy($id){
        $this->accion = Accion::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Accion::find($this->accion->id)->delete();
        session()->flash('message', 'Equipo Eliminado Exitosamente.');
        $this->closeConfimModal();
    }
    
    public function render()
    {
        if($this->search){
            return view('livewire.equipo.accion-component', ['acciones' => Accion::where('equipo_id', '=', $this->equipo->id)->where('descripcion', 'LIKE', '%'.$this->search.'%')->get()]);
        }
        return view('livewire.equipo.accion-component', ['acciones' => Accion::where('equipo_id', '=', $this->equipo->id)->latest()->get()]);
    }
}
