<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $withCount = ['likes'];

    protected $fillable = [
        'image',
        'content',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(OfferLike::class);
    }

    public function applications()
    {
        return $this->hasMany(OfferApplication::class);
    }
}
