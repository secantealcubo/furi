<?php

namespace App\Http\Livewire\RolUsuario;

use App\Models\Modulo;
use App\Models\ModuloPermiso;
use App\Models\EmpresaRol;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Form extends Component
{

  // component properties
  public $formMode;
  public $roleId;

  // form inputs
  public $name;

  // modulos y permisos
  public $modules;
  public $permissions=[];

  protected $rules = [
    'name' => 'required|unique:roles|min:3'
  ];

  public function mount()
  {
    if($this->formMode == 'edit'){
      $this->editData($this->roleId);
    }
  }

  public function render()
  {
    
    $this->modules = Modulo::with('permisos')->get();
    return view('livewire.rol-usuario.form')->layout('layouts.master');
  }

  public function createRole()
  {

    $this->validate();
    // reemplaza espacios por guines
    $this->name = strtr($this->name, ' ', '-');

    // pasa todo a minusculas
    $this->name = strtolower($this->name);

    $role = Role::create([
      'name' => $this->name,
      'guard_name' =>'web'
    ]);
    
    foreach ($this->permissions as $permission)
    {
        $role->givePermissionTo($permission['id']);
    }

    // send toast
    session()->flash('toast', ['success', 'Rol creado']);
    
    return redirect()->to(route('roles.index'));
  }

  public function updateRole()
  {
    $role = Role::where('id', $this->roleId)->first();

    // remover todos los permisos
    foreach($role->permissions as $permission) {
      $role->revokePermissionTo($permission['name']);  
    }

    // asociar nuevos permisos
    foreach ($this->permissions as $permission) {
      $role->givePermissionTo($permission['name']);
    }

    $this->name = strtr($this->name, ' ', '-');
    $this->name = strtolower($this->name);

    $role->name = $this->name;
    $role->save();

    // send toast
    session()->flash('toast', ['success', 'Rol actualizado']);

    return redirect()->route('roles.index');
  }

  public function editData($roleId)
  {
    $role = Role::find($roleId);
    foreach ($role->permissions->toArray() as $permission) {
      $element = [
        'id' => $permission['id'],
        'name' => $permission['name'],
        'guard_name' => $permission['guard_name'],
        'created_at' => $permission['created_at'],
        'updated_at' => $permission['updated_at'],
        'deleted_at' => $permission['deleted_at'],
      ];

      array_push($this->permissions, $element);

    }

    if($role->name == 'super-admin'){
      return redirect()->route('roles.index');
    }

    $this->name = $role->name;
  }

  public function handlePermission($permission)
  {
    if(in_array($permission, $this->permissions))
    {
      $index = array_search($permission, $this->permissions);
      array_splice($this->permissions, $index, 1);
    }else{
      array_push($this->permissions, $permission);
    }
  }

  public function getModulesRole()
  {

    foreach (\Auth::user()->getPermissionsViaRoles() as $key => $value) {
      $modulo_permiso=ModuloPermiso::where('permiso_id',$value->id)->first();
      if($modulo_permiso)
      {
        $modulo[]=$modulo_permiso->modulo_id;
      }
    }
    $modulo_bd=Modulo::whereIn('id',$modulo)->with('permisos')->get();
    return $modulo_bd;
  }

}
