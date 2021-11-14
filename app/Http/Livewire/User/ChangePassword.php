<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class ChangePassword extends Component
{
    public $user;
    
    public function render()
    {
        return view('livewire.user.change-password');
    }
}
