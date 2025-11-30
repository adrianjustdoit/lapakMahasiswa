<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProfileUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_name',
        'shop_description',
        'status',
        'admin_notes',
    ];

    /**
     * Get the user that owns the profile update request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the update is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
