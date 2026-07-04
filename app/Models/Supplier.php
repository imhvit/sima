<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'document_number',
        'email',
        'phone',
        'address',
        'contact_name',
        'is_active',
        'notes'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
