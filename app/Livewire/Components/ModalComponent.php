<?php

namespace App\Livewire\Components;

use App\Livewire\Users\UsersList;
use Livewire\Component;

class ModalComponent extends Component
{
    public $modaldata;
    public $eventName;
    public $title;
    public $text;


    // public function deleteConfirmed()
    // {
    //     $this->dispatch($this->eventName, ['modaldata' => $this->modaldata]);
    // }
    public function render()
    {
        return view('livewire.components.modal-component')->layout('layouts.app');
    }
}
