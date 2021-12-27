<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Channel extends Model
{
    protected $fillable = [
        'name', 'description'
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
