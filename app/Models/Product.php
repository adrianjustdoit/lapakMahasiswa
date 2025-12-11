<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductGuestReview;
use App\Models\ProductPhoto;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',          
        'name',
        'category',
        'description',      
        'shop_name',        
        'condition',        
        'min_order',        
        'showcase',         
        'price',            
        'average_rating',   
        'reviews_count',    
        'sold_count',
        'stock',
    ];

    // Daftar kategori yang tersedia
    public static function categories(): array
    {
        return [
            'fashion' => 'Fashion',
            'kecantikan' => 'Kecantikan',
            'rumah' => 'Rumah',
            'elektronik' => 'Elektronik',
            'hobi' => 'Hobi',
            'lainnya' => 'Lainnya',
        ];
    }

    protected $casts = [
        'price'          => 'integer',
        'min_order'      => 'integer',
        'average_rating' => 'float',
        'reviews_count'  => 'integer',
        'sold_count'     => 'integer',
        'stock'          => 'integer',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function guestReviews()
    {
        return $this->hasMany(ProductGuestReview::class);
    }
}