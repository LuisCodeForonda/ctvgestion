<?php

namespace App\Livewire\Post;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Noticia;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class NoticiaComponent extends Component
{

    use WithPagination;
    use WithFileUploads;

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
    public $oldImage = '';


    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset('noticia_id', 'titulo', 'slug', 'body', 'image', 'categoria_id', 'user_id');
        $this->resetValidation();
    }

    public function openConfirmModal()
    {
        $this->showDeleteModal = true;
    }

    public function closeConfimModal()
    {
        $this->showDeleteModal = false;
        $this->reset('noticia_id', 'noticia', 'titulo', 'slug', 'body', 'image', 'categoria_id', 'user_id');
    }

    public function store()
    {
        if (!$this->noticia_id) {
            $this->validate([
                'titulo' => 'required|min:3|max:100',
                'body' => 'required',
                'image' => 'required|image|max:1024|mimes:jpg,png,jpeg',
                'categoria_id' => 'required',
            ]);

            //subiendo la imagen al servidor
            if ($this->image) {
                $this->image = $this->image->store('uploads', 'public');
            }

            Noticia::create([
                'titulo' => $this->titulo,
                'slug' => Str::slug($this->titulo),
                'body' => $this->body,
                'image' => $this->image,
                'categoria_id' => $this->categoria_id,
                'user_id' => Auth::user()->id,
            ]);
        } else {

            $this->validate([
                'titulo' => 'required|min:3|max:100',
                'body' => 'required',
                'image' => 'required|image|max:1024|mimes:jpg,png,jpeg',
                'categoria_id' => 'required',
            ]);

            //subiendo la nueva foto
            if ($this->image) {
                $this->image = $this->image->store('uploads', 'public');
            }

            //eliminando la antigua foto
            if ($this->oldImage) {
                $image_path = 'storage/' . $this->oldImage;
                unlink($image_path);
            }

            Noticia::updateOrCreate(['id' => $this->noticia_id], [
                'titulo' => $this->titulo,
                'slug' => Str::slug($this->titulo),
                'body' => $this->body,
                'fecha' => $this->fecha,
                'image' => $this->image,
                'categoria_id' => $this->categoria_id,
                'user_id' => Auth::user()->id,
            ]);
        }

        session()->flash(
            'message',
            $this->noticia_id ? 'Post Actualizado Exitosamente.' : 'Post Creado Exitosamente.'
        );

        $this->closeModal();
    }

    public function edit($id)
    {
        $noticia = Noticia::findOrFail($id);
        $this->noticia_id = $id;
        $this->titulo = $noticia->titulo;
        $this->slug = $noticia->slug;
        $this->body = $noticia->body;
        $this->oldImage = $noticia->image;
        $this->categoria_id = $noticia->categoria_id;


        $this->openModal();
    }

    public function destroy($id)
    {
        $this->noticia = Noticia::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        Noticia::find($this->noticia->id)->delete();
        session()->flash('message', 'Equipo Eliminado Exitosamente.');
        $this->closeConfimModal();
    }

    public function render()
    {
        return view('livewire.post.noticia-component', ['noticias' => Noticia::latest()->paginate($this->paginate), 'categorias' => Categoria::all()]);
    }
}
