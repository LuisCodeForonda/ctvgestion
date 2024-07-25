<?php

namespace App\Livewire\Post;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class NoticiaComponent extends Component
{

    public $noticia_id;
    public $titulo;
    public $slug;
    public $body;
    public $image;
    public $categoria_id;
    public $user_id;

    //variables
    public $noticia = null;
    public $isOpen = false;
    public $paginate = 10;
    public $showDeleteModal = false;
    public $search = '';


    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->reset('noticia_id', 'titulo', 'slug', 'body', 'image', 'categoria_id', 'user_id');
        $this->resetValidation();
    }

    public function openConfirmModal(){
        $this->showDeleteModal = true;
    }

    public function closeConfimModal(){
        $this->showDeleteModal = false;
        $this->reset('noticia_id', 'noticia', 'titulo', 'slug', 'body', 'image', 'categoria_id', 'user_id');
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
        return view('livewire.post.noticia-component');
    }
}
