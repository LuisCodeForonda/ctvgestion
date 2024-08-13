<?php

namespace App\Livewire\Equipo;

use App\Models\Archivo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ArchivoComponent extends Component
{

    use WithFileUploads;

    //require el id del equipo
    public $equipo;

    //variables del modelo
    public $archivo_id;
    public $nombre;
    public $file = [];
    public $extension;
    public $equipo_id;
    public $archivo;

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
        $this->reset('nombre', 'file', 'extension', 'equipo_id');
        $this->resetValidation();
    }

    public function openConfirmModal()
    {
        $this->showDeleteModal = true;
    }

    public function closeConfimModal()
    {
        $this->showDeleteModal = false;
        $this->reset('archivo_id', 'nombre', 'file', 'extension', 'equipo_id', 'archivo');
    }

    //fuciones para el crud del modelo
    public function store()
    {

        $this->validate([
            'file.*' => 'required|max:1024',
        ]);

        //logica para almacenar el archivo
        foreach ($this->file as $item) {
            $nombre = $item->getClientOriginalName();
            $extension = $item->getClientOriginalExtension();
            $file = $item->store('public/uploads');

            //almacenamos la imagen
            Archivo::create([
                'nombre' => $nombre,
                'file' => $file,
                'extension' => $extension,
                'equipo_id' => $this->equipo->id,
            ]);
        }

        session()->flash(
            'message',
            $this->archivo_id ? 'Actualizado Exitosamente.' : 'Creado Exitosamente.'
        );

        $this->closeModal();
    }

    public function destroy($id)
    {
        $this->archivo = Archivo::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        $archivo = Archivo::findOrFail($this->archivo->id);
        Storage::delete($archivo->file);
        $archivo->delete();
        session()->flash('message', 'Eliminado Exitosamente.');
        $this->closeConfimModal();
    }

    public function download($archivo, $name)
    {
        //dump($archivo);
        return Storage::download($archivo, $name);
    }


    public function render()
    {
        return view('livewire.equipo.archivo-component', ['archivos' => Archivo::where('equipo_id', $this->equipo->id)->latest()->get()]);
    }
}
