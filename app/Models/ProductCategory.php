<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['product_type'];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}
