<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupBudgetTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_type_id',
        'for_budget_id',
        'amount',
        'date',
        'category_id',
        'paymode_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
