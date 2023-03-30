<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    public function sent()
    {
        return $this->hasMany(Message::class, 'message_from', 'id');
    }

    public function received()
    {
        return $this->hasMany(Message::class, 'message_to', 'id');
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'user_id', 'id');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'followed_by', 'id');
    }
}
