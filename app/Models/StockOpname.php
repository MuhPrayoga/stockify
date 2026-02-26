<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    protected $fillable = [
        'product_id',
        'system_stock',
        'physical_stock',
        'difference',
        'notes',
        'checked_by',
        'checked_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function checker()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}

