<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;



#[Layout('layouts.master')]
class Dashboard extends Component
{
    public function goToDashboard()
    {
        return redirect()->route('dashboard');
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
