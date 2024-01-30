<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupBudget extends Model
{

    protected $fillable = ['budget_name', 'budget_amount'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groupTransactions()
    {
        return $this->hasMany(GroupBudgetTransaction::class, 'for_budget_id');
    }
}
