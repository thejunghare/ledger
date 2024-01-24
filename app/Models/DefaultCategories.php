<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultCategories extends Model
{
    use HasFactory;
    protected $table = 'default_categories';
    public function defaultCategories()
    {
        return $this->belongsTo(User::class);
    }


    public function defaultCategoryType()
    {
        return $this->belongsTo(DefaultCategoryType::class, 'category_type_id');
    }
}
