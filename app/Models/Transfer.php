<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'origin_warehouse_id',
        'destination_warehouse_id',
        'user_id',
        'status',
        'transfer_date',
        'notes'
    ];

    public function originWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'origin_warehouse_id');
    }

    public function destinationWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'destination_warehouse_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transferItems()
    {
        return $this->hasMany(TransferItem::class);
    }
}
