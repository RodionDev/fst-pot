<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Channel extends Model
{
    protected $fillable = [
        'name', 'description', 'display_time_ms', 'transition_time_ms', 'refresh_time_ms'
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
