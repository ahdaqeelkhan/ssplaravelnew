<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Laravel\Auth\User as MongoUser;


class User extends Eloquent implements Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Set default value for 'role' to 'user'
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->role)) {
                $user->role = 'user'; // Default to 'user' if no role is set
            }
        });
    }
    

    // Implement the required methods for authentication
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getAuthPasswordName()
    {
        return 'password';
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }
}
