<?php

namespace App\Livewire\Post;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class CategoriaComponent extends Component
{
    use WithPagination;

    #[Rule('required|min:2|max:30|unique:categorias')]
    public $name;

    public $categoria = null;
    public $categoria_id = null;
    public $isOpen = false;
    public $paginate = 10;
    public $showDeleteModal = false;
    public $search = '';

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->reset('name', 'categoria_id');
        $this->resetValidation();
    }

    public function openConfirmModal(){
        $this->showDeleteModal = true;
    }

    public function closeConfimModal(){
        $this->showDeleteModal = false;
        $this->reset('name', 'categoria', 'categoria_id');
    }

    public function store(){ 
    
        $this->validate();

        Categoria::updateOrCreate(['id' => $this->categoria_id], [
            'name' => $this->name,
        ]);

        session()->flash('message',
            $this->categoria_id ? 'Categoria Actualizada Exitosamente.' : 'Categoria Creado Exitosamente.');

        $this->closeModal();
    }

    public function edit($id){
        $categoria = Categoria::findOrFail($id);
        $this->categoria_id = $id;
        $this->name = $categoria->name;
        
        $this->openModal();
    }

    public function destroy($id){
        $this->categoria = Categoria::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Categoria::find($this->categoria->id)->delete();
        session()->flash('message', 'Categoria Eliminado Exitosamente.');
        $this->closeConfimModal();
    }

    public function render()
    {
        if($this->search){
            $this->resetPage();
            return view('livewire.post.categoria-component',  ['categorias' => Categoria::where('name', 'LIKE', '%'.$this->search.'%')->paginate($this->paginate)]);
        }
        return view('livewire.post.categoria-component', ['categorias' => Categoria::latest()->paginate($this->paginate)]);
    }
}
