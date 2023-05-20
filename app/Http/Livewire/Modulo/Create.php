<?php

namespace App\Http\Livewire\Modulo;

use Livewire\Component;

class Create extends Component
{

  public function render()
  {
    return view('livewire.modulo.create')->layout('layouts.master');
  }
}
