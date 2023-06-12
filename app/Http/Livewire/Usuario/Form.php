<?php

namespace App\Http\Livewire\Usuario;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $rolUsuario;
    public $userRoles;
    public $user;

    // Component parameters
    public $mode;
    public $userId;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
        'rolUsuario' => 'required'
    ];

    protected $messages = [
        'name.required' => 'El "nombre" no debe estar vacío',
        'email.required' => 'El "correo electrónico" no debe estar vacío',
        'password.required' => 'La "contraseña" no debe estar vacío',
        'rolUsuario.required' => 'El "rol" no debe estar vacío',
        'password.confirmed' => 'La contraseña debe coincidir',
    ];

    public function mount()
    {
        if ($this->mode == 'edit') {
            $this->editUserData($this->userId);
        }

        $this->userRoles = Role::all();
    }

    public function render()
    {
        return view('livewire.usuario.form');
    }

    public function crearUsuario()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'rolUsuario' => 'required'
        ]);
    
        $usuario = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    
        $usuario->assignRole($this->rolUsuario);
        $url = route('usuarios.index');
        $this->emit('toast_aux', ['success', 'Creado correctamente', $url]);
    }  

    public function editUserData($userId)
    {
        $this->user = User::with('roles')->where('id', $userId)->first();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->rolUsuario = $this->user->getRoleNames()->first();
    }

    public function updateUser()
    {
        $this->user->name = $this->name;
    
        if ($this->user->email !== $this->email) {
            if (User::where('email', $this->email)->exists()) {
                $this->emit('toast', ['warning', 'El correo electrónico ya existe']);
                return;
            }
    
            $this->user->email = $this->email;
        }
        if($this->user->getRoleNames()->first())
        {
            $this->user->removeRole($this->user->getRoleNames()->first());
        }
        $this->user->assignRole($this->rolUsuario);
    
        if (!empty($this->password)) {
            if ($this->password != $this->password_confirmation) {
                $this->emit('toast', ['warning', 'Las contraseñas no coinciden']);
                return;
            }
    
            $this->user->password = Hash::make($this->password);
        }
    
        $this->user->save();
    
        $url = route('usuarios.index');
        $this->emit('toast_aux', ['success', 'Actualizado correctamente', $url]);
    }
   
}
