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
    public $observaciones;
    public $modelo;
    public $serie;
    public $serietec;
    public $estado;
    public $area;
    public $ubicacion;
    public $marca_id;
    public $encargado_id;
    public $equipo;

    //variables
    public $isOpen = false;
    public $paginate = 10;
    public $showDeleteModal = false;
    public $search = '';

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->reset('descripcion', 'observaciones', 'modelo', 'serie', 'serietec', 'estado', 'area', 'ubicacion', 'marca_id', 'encargado_id');
        $this->resetValidation();
    }

    public function openConfirmModal(){
        $this->showDeleteModal = true;
    }

    public function closeConfimModal(){
        $this->showDeleteModal = false;
        $this->reset('descripcion', 'observaciones', 'modelo', 'serie', 'serietec', 'estado', 'area', 'ubicacion', 'marca_id', 'encargado_id', 'equipo');
    }

    public function store(){

        $this->validate([
            'descripcion' => 'required|min:3|max:400',
            'observaciones' => 'max:150',
            'modelo' => 'max:30',
            'serie' => 'max:50',
            'serietec' => 'required|max:50|unique:equipos',
            'estado' => 'required|numeric|min:1|max:4',
            'area' => '',
            'ubicacion' => '',
            'marca_id' => '',
            'encargado_id' => '',
        ]);

        if(!$this->equipo_id){
            Equipo::create([
                'descripcion' => $this->descripcion,
                'observaciones' => $this->observaciones,
                'modelo' => $this->modelo,
                'serie' => $this->serie,
                'serietec' => Str::slug($this->serietec),
                'estado' => $this->estado,
                'area' => $this->area,
                'ubicacion' => $this->ubicacion,
                'marca_id' => $this->marca_id,
                'encargado_id' => $this->encargado_id,
            ]);
        }else{
            Equipo::updateOrCreate(['id' => $this->equipo_id], [
                'descripcion' => $this->descripcion,
                'observaciones' => $this->observaciones,
                'modelo' => $this->modelo,
                'serie' => $this->serie,
                'serietec' => Str::slug($this->serietec),
                'estado' => $this->estado,
                'area' => $this->area,
                'ubicacion' => $this->ubicacion,
                'marca_id' => $this->marca_id,
                'encargado_id' => $this->encargado_id,
            ]);
        }

        session()->flash('message',
            $this->equipo_id ? 'Actualizado Exitosamente.' : 'Creado Exitosamente.');

        $this->closeModal();
    }

    public function edit($id){
        $equipo = Equipo::findOrFail($id);
        $this->equipo_id = $id;
        $this->descripcion = $equipo->descripcion;
        $this->observaciones = $equipo->observaciones;
        $this->modelo = $equipo->modelo;
        $this->serie = $equipo->serie;
        $this->serietec = $equipo->serietec;
        $this->estado = $equipo->estado;
        $this->area = $equipo->area;
        $this->ubicacion = $equipo->ubicacion;
        $this->marca_id = $equipo->marca_id;
        $this->encargado_id = $equipo->encargado_id;
        
        $this->openModal();
    }

    public function destroy($id){
        $this->equipo = Equipo::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Equipo::find($this->equipo->id)->delete();
        session()->flash('message', 'Eliminado Exitosamente.');
        $this->closeConfimModal();
    }

    public function render()
    {
        if($this->search){
            $this->resetPage();
            return view('livewire.equipo.equipo-component',  ['equipos' => Equipo::where('descripcion', 'LIKE', '%'.$this->search.'%')->paginate($this->paginate), 'marcas'=>Marca::all(), 'encargados' => Persona::all()]);
        }
        return view('livewire.equipo.equipo-component', ['equipos' => Equipo::latest()->paginate($this->paginate), 'marcas'=>Marca::all(), 'encargados' => Persona::all()]);
    }
}
