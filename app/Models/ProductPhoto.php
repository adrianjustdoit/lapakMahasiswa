<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'path',      // path file di storage
        'is_cover',  // apakah foto utama
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}