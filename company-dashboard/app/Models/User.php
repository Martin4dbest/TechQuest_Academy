<?php

//namespace App;
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a one-to-many relationship with SocialProvider.
     */
    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }

    /**
     * Define a one-to-many relationship with SignIn.
     */
    public function signIn()
    {
        return $this->hasMany(SignIn::class);
    }

    /**
     * Define a one-to-many relationship with SignOut.
     */
    public function signOut()
    {
        return $this->hasMany(SignOut::class);
    }
}
