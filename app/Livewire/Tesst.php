<?php

namespace App\Livewire;

use Livewire\Component;

class Tesst extends Component
{

    public string $pageTitle = "صفحة الاختبار"; // عنوان مختلف لكل مكون



    public function tesstt(){
        dd('ooooooo');
    }
    
    public function render()
    {
        return view('livewire.tesst', ['pageTitle' => $this->pageTitle])->layout('layouts.app');
    }
}
