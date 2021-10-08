<?php
namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $fillable = [
        'username', 'first_name', 'last_name', 'email', 'password', 'is_admin', 'approved_at', 'rejected_at'
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];
    protected $casts = [
        'is_admin' => 'boolean'
    ];
    protected $dates = [
        'email_verified_at', 'approved_at', 'rejected_at'
    ];
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getRejectedAttribute()
    {
        return $this->rejected_at == null ? false : true;
    }
    public function getApprovedAttribute()
    {
        return $this->approved_at == null ? false : true;
    }
    public function getPendingAttribute()
    {
        return ($this->approved_at == null && $this->rejected_at == null) ? true : false;
    }
    public function scopeAdmins($query) {
        return $query
                ->whereNotNull('email_verified_at')
                ->where('is_admin', 1);
    }
    public function scopeConsumers($query) {
        return $query
                ->whereNotNull('email_verified_at')
                ->where('is_admin', 0);
    }
    public function scopeRejected($query) {
        return $query
                ->whereNotNull('email_verified_at')
                ->whereNotNull('rejected_at');
    }
    public function scopeApproved($query) {
        return $query
                ->whereNotNull('email_verified_at')
                ->whereNotNull('approved_at');
    }
    public function scopePending($query) {
        return $query
                ->whereNotNull('email_verified_at')
                ->whereNull('approved_at')
                ->whereNull('rejected_at');
    }
    public function scopeVerified($query) {
        return $query->whereNotNull('email_verified_at');
    }
    public function scopeUnverified($query) {
        return $query->whereNull('email_verified_at');
    }
}
