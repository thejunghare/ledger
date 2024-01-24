<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultCategoryType extends Model
{
    use HasFactory;

    public function defaultCategories()
    {
        return $this->hasMany(DefaultCategories::class, 'category_type_id');
    }
}
