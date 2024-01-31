<?php

namespace App\Livewire\GroupBudgetTransactions;

use App\Models\GroupBudgetTransaction;
use Livewire\Component;
use Livewire\Attributes\Title;


class TransactionsIndex extends Component
{
    public $transactions;
    public function mount()
    {
        $this->transactions = GroupBudgetTransaction::with('user')->get()
        ;
    }
    public function render()
    {
        return view('livewire.group-budget-transactions.transactions-index')
            ->title('Transactions - ledger'); //this isn't an error
    }
}
