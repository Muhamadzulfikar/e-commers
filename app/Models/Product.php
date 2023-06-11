<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['product_category_id', 'product_name', 'product_price', 'short_description', 'description', 'weight', 'image_product'];

    public function productCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function shoppingCarts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ShoppingCart::class, 'product_id');
    }

    /**
     * Because we don't trust that the 'summernote' db column does not already
     * have some JS stored inside the HTML, we will sanitize the output using
     * https://github.com/mewebstudio/Purifier
     */
    public function getSummernoteAttribute($value)
    {
        return clean($value);
    }
}
