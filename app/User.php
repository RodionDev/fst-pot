<?php
namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $fillable = [
        'username', 'first_name', 'last_name', 'email', 'password', 'admin', 'approved_at'
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
}
