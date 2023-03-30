<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'followed_by'
    ];

    public function follower()
    {
        return $this->belongsTo(User::class , 'followed_by' , 'id');
    }

    public function follow()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
