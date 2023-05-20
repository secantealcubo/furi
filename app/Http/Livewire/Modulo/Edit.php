<?php

namespace App\Http\Livewire\Modulo;

use Livewire\Component;

class Edit extends Component
{
  
  public $moduleId;

  public function mount($id){
    $this->moduleId = $id;
  }

  public function render()
  {
    return view('livewire.modulo.edit')->layout('layouts.master');
  }
}
