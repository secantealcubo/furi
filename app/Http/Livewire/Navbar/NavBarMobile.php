<?php

namespace App\Http\Livewire\Navbar;

use Livewire\Component;

class NavBarMobile extends Component
{
    public $menuBar = "";
    
    public function openBar($numero)
    {

        if($this->menuBar == $numero)
        {
            $this->menuBar = 0;
        }
        else{
            $this->menuBar = $numero;
        }
        
    }

    public function render()
    {
        return view('livewire.navbar.nav-bar-mobile');
    }
}
