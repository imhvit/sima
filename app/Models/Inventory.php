<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'warehouse_id',
        'product_id',
        'stock',
        'reserved_stock',
    ];

    protected $appends = ['available_stock'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getAvailableStockAttribute()
    {
        return $this->stock - $this->reserved_stock;
    }
}
