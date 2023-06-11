<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'shippings';
    protected $primaryKey = 'id';
    protected $fillable = ['shipping_type', 'partner_name', 'estimation_day', 'price'];

    public function salesInvoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SalesInvoice::class, 'shipping_id');
    }
}
