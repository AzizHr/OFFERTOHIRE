<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'message_from',
        'message_to'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class , 'message_from' , 'id');
    }

}
