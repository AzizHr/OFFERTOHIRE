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
        'avatar',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sent()
    {
        return $this->hasMany(UserMessage::class , 'sender_id');
    }

    public function received()
    {
        return $this->hasMany(UserMessage::class , 'receiver_id');
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class , 'user_id');
    }

    public function following()
    {
        return $this->hasMany(Follower::class , 'follower_id');
    }

    public function applications()
    {
        return $this->hasMany(OfferApplication::class);
    }
}
