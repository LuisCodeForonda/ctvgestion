<?php

namespace App\Livewire\Equipo;

use Livewire\Component;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Persona;
use Illuminate\Support\Str;
use Livewire\WithPagination;


class EquipoComponent extends Component
{
    use WithPagination;
    
    //data
    public $equipo_id;
    public $descripcion;
    public $marca_id;
    public $modelo;
    public $serie;
    public $serietec;
    public $estado;
    public $observaciones;
    public $persona_id;

    //variables
    public $equipo = null;
    public $isOpen = false;
    public $paginate = 10;
    public $showDeleteModal = false;
    public $search = '';

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->reset('equipo_id', 'descripcion', 'marca_id', 'modelo', 'serie', 'serietec', 'estado', 'observaciones', 'persona_id');
        $this->resetValidation();
    }

    public function openConfirmModal(){
        $this->showDeleteModal = true;
    }

    public function closeConfimModal(){
        $this->showDeleteModal = false;
        $this->reset('equipo', 'equipo_id', 'descripcion', 'marca_id', 'modelo', 'serie', 'serietec', 'estado', 'observaciones', 'persona_id');
    }

    public function store(){
        if(!$this->equipo_id){
            $this->validate([
                'descripcion' => 'required|min:3|max:400',
                'marca_id' => '',
                'modelo' => 'max:30',
                'serie' => 'max:50',
                'serietec' => 'required|max:50|unique:equipos',
                'estado' => 'required|numeric|min:1|max:4',
                'observaciones' => 'max:150',
                'persona_id' => '',
            ]);
            Equipo::create([
                'descripcion' => $this->descripcion,
                'marca_id' => $this->marca_id,
                'modelo' => $this->modelo,
                'serie' => $this->serie,
                'serietec' => $this->serietec,
                'estado' => $this->estado,
                'observaciones' => $this->observaciones,
                'persona_id' => $this->persona_id,
                'slug' => Str::slug($this->serietec),
            ]);
        }else{
            $this->validate([
                'descripcion' => 'required|min:3|max:400',
                'marca_id' =>'',
                'modelo' => 'max:30',
                'serie' => 'max:50',
                'estado' => 'required|numeric|min:1|max:4',
                'observaciones' => 'max:150',
                'persona_id' => '',
            ]);
            Equipo::updateOrCreate(['id' => $this->equipo_id], [
                'descripcion' => $this->descripcion,
                'marca_id' => $this->marca_id,
                'modelo' => $this->modelo,
                'serie' => $this->serie,
                'estado' => $this->estado,
                'observaciones' => $this->observaciones,
                'persona_id' => $this->persona_id,
            ]);
        }

        session()->flash('message',
            $this->equipo_id ? 'Equipo Actualizado Exitosamente.' : 'Equipo Creado Exitosamente.');

        $this->closeModal();
    }

    public function edit($id){
        $equipo = Equipo::findOrFail($id);
        $this->equipo_id = $id;
        $this->descripcion = $equipo->descripcion;
        $this->marca_id = $equipo->marca_id;
        $this->modelo = $equipo->modelo;
        $this->serie = $equipo->serie;
        $this->serietec = $equipo->serietec;
        $this->estado = $equipo->estado;
        $this->observaciones = $equipo->observaciones;
        $this->persona_id = $equipo->persona_id;
        
        $this->openModal();
    }

    public function destroy($id){
        $this->equipo = Equipo::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Equipo::find($this->equipo->id)->delete();
        session()->flash('message', 'Equipo Eliminado Exitosamente.');
        $this->closeConfimModal();
    }

    public function render()
    {
        if($this->search){
            $this->resetPage();
            return view('livewire.equipo.equipo-component',  ['equipos' => Equipo::where('descripcion', 'LIKE', '%'.$this->search.'%')->paginate($this->paginate), 'marcas'=>Marca::all(), 'personas' => Persona::all()]);
        }
        return view('livewire.equipo.equipo-component', ['equipos' => Equipo::latest()->paginate($this->paginate), 'marcas'=>Marca::all(), 'personas' => Persona::all()]);
    }
}
