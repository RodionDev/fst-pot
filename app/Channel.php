<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Channel extends Model
{
    public function devices ()
    {
        return $this->hasMany('App\Device');
    }
    public function screens ()
    {
        return $this->hasMany('App\Screen');
    }
}
