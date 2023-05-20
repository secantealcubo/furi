<?php

namespace App\Http\Livewire\Modulo;

use App\Models\Modulo;
use App\Models\ModuloPermiso;
use Livewire\Component;

class Index extends Component
{

  public $moduloId;

  // event listener
  protected $listeners = ['deleteConfirmed' => 'deleteModule'];

  public function render()
  {
    $modules = Modulo::paginate(15);
    return view('livewire.modulo.index', [
      'modulos' => $modules
    ])->layout('layouts.master');
  }


  public function confirmDelete($encodedID)
  {
    $this->emit('confirmDelete');
    $this->moduloId = base64_decode($encodedID);
  }

  public function deleteModule()
  {

    // delete module permissions
    $modulePermissions = ModuloPermiso::where('modulo_id', $this->moduloId)->get();
    foreach ($modulePermissions as $modulePermission) {
      $modulePermission->delete();
    };

    $module = Modulo::find($this->moduloId);
    $module->delete();

    $this->emit('toast', ['warning', 'Módulo eliminado']);
  }
}
