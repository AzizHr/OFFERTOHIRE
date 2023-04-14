<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter',
        'offer_id',
        'user_id'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
