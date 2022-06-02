<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Channel extends Model
{
    protected $fillable = [
        'name', 'description', 'display_time', 'transition_time', 'refresh_time'
    ];
    protected $hidden = [
        'id', 'user_id', 'created_at', 'updated_at'
    ];
    public function user ()
    {
        return $this->belongsTo('App\User');
    }
    public function devices ()
    {
        return $this->hasMany('App\Device');
    }
    public function screens ()
    {
        return $this->hasMany('App\Screen');
    }
}
