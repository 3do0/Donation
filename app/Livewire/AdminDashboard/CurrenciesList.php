<?php

namespace App\Livewire\AdminDashboard;

use App\Models\CurrencyRate;
use Livewire\Component;

class CurrenciesList extends Component
{
    public $currencies;

    public function refreshCurrencies()
    {
        $this->currencies = CurrencyRate::get();
    }

    function placeholder()
    {
        return view('layouts.components.placeholdeScreens.tablesSkeleton');
    }

    public function mount()
    {
        $this->refreshCurrencies();
    }

    public function render()
    {
        return view('livewire.admin-dashboard.currencies-list')->layout('layouts.app');
    }
}
