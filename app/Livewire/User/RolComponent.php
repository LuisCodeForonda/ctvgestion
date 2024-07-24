<?php

namespace App\Livewire\User;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\Rule;


class RolComponent extends Component
{
    #[Rule('required|string|min:3|unique:roles,name')]
    public $roleName;

    public $rol;
    public $rol_id;

    public $selectedPermissions = [];
    public $permissions = [];

    public $isOpen = false;
    public $paginate = 10;

    public function mount()
    {
        //obtenemos los registro agrupados por la categoria y lo combertimos en un array
        $this->permissions = Permission::all()->groupBy('category')->toArray();
    }

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->reset(['roleName', 'selectedPermissions', 'rol_id']);
        $this->resetValidation();
    }

    public function store(){ 
        if($this->rol_id){
            $this->validate(['roleName' => 'required|string|min:3']);
            $this->rol->update(['name' => $this->roleName]);
            $this->rol->syncPermissions($this->selectedPermissions);
        }else{
            $this->validate();
            $rol = Role::create(['name' => $this->roleName]);
            $rol->syncPermissions($this->selectedPermissions);
        }

        $this->closeModal();
    }

    public function edit(Role $rol){
        $this->rol_id = $rol->id;
        $this->rol = $rol;
        $this->permissions = Permission::all()->groupBy('category')->toArray();//obtenemos los registro agrupados por la categoria y lo combertimos en un array
        $this->selectedPermissions = $rol->permissions()->pluck('name')->toArray(); //obtenemos todos los permisos del rol seleccionado
        $this->roleName = $rol->name;
        $this->openModal();
    }

    public function render()
    {
        return view('livewire.user.rol-component', ['roles' => Role::latest()->paginate($this->paginate)]);
    }
}
