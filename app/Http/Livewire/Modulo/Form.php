<?php

namespace App\Http\Livewire\Modulo;

use App\Models\Modulo;
use Livewire\Component;

class Form extends Component
{
  // propiedades del componente
  public $formMode;
  public $moduleId;

  // variables internas del componente
  public $nombre;
  public $modelo;

  protected $rules = [
    'nombre' => 'required|unique:modulos,nombre,NULL,id,deleted_at,NULL|min:3',
    'modelo' => 'required|unique:modulos,modelo,NULL,id,deleted_at,NULL'
  ];

  public function mount()
  {
    if($this->formMode == 'edit')
    {
      $this->editModule();
    }
  }

  public function render()
  {
    return view('livewire.modulo.form')->layout('layouts.master');
  }

  public function createModule()
  {
    //$this->validate();

    Modulo::create([
      'nombre' => $this->nombre,
      'modelo' => $this->modelo,
    ]);

    session()->flash('toast', ['success', 'Módulo registrado']);
    return redirect()->route('modulos.index');
  }

  public function editModule()
  {
    $module = Modulo::find($this->moduleId);
    $this->nombre = $module->nombre;
    $this->modelo = $module->modelo;
  }

  public function updateModule()
  {
    //$this->validate();

    $module = Modulo::find($this->moduleId);
    $module->nombre = $this->nombre;
    $module->modelo = $this->modelo;

    $module->save();

    session()->flash('toast', ['success', 'Módulo actualizado']);

    return redirect()->route('modulos.index');

  }

}

