<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Models\GroupBudgetTransaction;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected
    $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected
    $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected
    $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];




    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function groupBudgets()
    {
        return $this->hasMany(GroupBudget::class);
    }

    public function groupBudgetTransactions()
    {
        return $this->hasMany(GroupBudgetTransaction::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function defaultCategories()
    {
        return $this->hasMany(DefaultCategories::class);
    }
}
