<?php

namespace App\Livewire\Equipo;

use Livewire\Component;
use App\Models\Accesorio;
use App\Models\Equipo;
use App\Models\Marca;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class AccesorioComponent extends Component
{
    
    use WithPagination;

    public $slug;

    public $accesorio_id;

    #[Rule('required|min:3|max:200')]
    public $descripcion;

    #[Rule('')]
    public $equipo_id;

    public $marca_id;

    #[Rule('max:30')]
    public $modelo;

    #[Rule('max:50')]
    public $serie;

    #[Rule('required|integer')]
    public $cantidad = 1;

    public $accesorio = null;
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
        $this->reset('accesorio_id', 'descripcion', 'equipo_id', 'marca_id', 'modelo', 'serie', 'cantidad');
        $this->resetValidation();
    }

    public function openConfirmModal(){
        $this->showDeleteModal = true;
    }

    public function closeConfimModal(){
        $this->showDeleteModal = false;
        $this->reset('accesorio', 'accesorio_id', 'descripcion', 'equipo_id', 'marca_id', 'modelo', 'serie', 'cantidad');
    }

    public function store(){ 
    
        $this->validate();

        Accesorio::updateOrCreate(['id' => $this->accesorio_id], [
            'descripcion' => $this->descripcion,
            'equipo_id' => $this->equipo->id,
            'marca_id' => $this->marca_id,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'cantidad' => $this->cantidad,
        ]);
        
        session()->flash('message',
            $this->accesorio_id ? 'Accesorio Actualizada Exitosamente.' : 'Accesorio Creado Exitosamente.');

        $this->closeModal();
    }

    public function edit($id){
        $accesorio = Accesorio::findOrFail($id);
        $this->accesorio_id = $id;
        $this->descripcion = $accesorio->descripcion;
        $this->equipo_id = $accesorio->equipo_id;
        $this->marca_id = $accesorio->marca_id;
        $this->modelo = $accesorio->modelo;
        $this->serie = $accesorio->serie;
        $this->cantidad = $accesorio->cantidad;
        $this->openModal();
    }

    public function destroy($id){
        $this->accesorio = Accesorio::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Accesorio::find($this->accesorio->id)->delete();
        session()->flash('message', 'Equipo Eliminado Exitosamente.');
        $this->closeConfimModal();
    }

    public function render()
    {
        return view('livewire.equipo.accesorio-component', ['accesorios' => Accesorio::where('equipo_id', '=', $this->equipo->id)->latest()->get(), 'marcas' => Marca::all()]);
    }
}
