<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;


class UserComponent extends Component
{
    
    use WithPagination;

    public $name, $email, $enabled = false, $password, $password_confirmation, $rol;

    public $user = null;
    public $user_id = null;
    public $isOpen = false;
    public $paginate = 10;
    public $search = '';


    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->reset('name', 'email', 'password', 'enabled', 'password_confirmation', 'user', 'rol', 'user_id');
        $this->resetValidation();
    }

    public function store(){ 
    
        if(!$this->user_id){
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password_confirmation' => ['required_with:password|same:password'],
            ]);
            
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'enabled' => $this->enabled,
                'rol' => $this->rol,
            ]);
        }else{
            //dump($this->enabled);
            $this->user->update([
                'enabled' => $this->enabled,
            ]);
            
            $this->user->syncRoles($this->rol);
        }
        
        

        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user = $user;
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->enabled = $user->enabled?true:false;
        $this->rol = $user->getRoleNames()->first();
        $this->openModal();
    }


    public function render()
    {
        if($this->search){
            $this->resetPage();
            return view('livewire.user.user-component' , ['usuarios' => User::where('name', 'LIKE', '%'.$this->search.'%')->paginate($this->paginate), 'roles' => Role::all()]);
        }
        return view('livewire.user.user-component', ['usuarios' => User::latest()->paginate($this->paginate), 'roles' => Role::all()]);
    }
}
