<?php

namespace App\Livewire;

use App\Models\Paymode;
use Livewire\Component;
use App\Models\DefaultCategories;

class DynamicSelect extends Component
{
    public $categories = [];
    public $paymodes = [];
    public $selectedTransactionType = 2; // Default transaction type to Expense

    public function mount()
    {
        $this->categories = $this->getCategoryOptions();
        $this->paymodes = $this->getPaymodeOptions();
    }

    public function updateTransactionType($value)
    {
        $this->selectedTransactionType = $value;
        $this->categories = $this->getCategoryOptions();
        $this->paymodes = $this->getPaymodeOptions();
    }

    private function getCategoryOptions()
    {
        return DefaultCategories::where('category_type_id', $this->selectedTransactionType)->get();
    }

    private function getPaymodeOptions()
    {
        return Paymode::all();
    }

    public function render()
    {
        return view('livewire.dynamic-select');
    }
}


