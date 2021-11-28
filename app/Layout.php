<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Layout extends Model
{
    public function screens () {
        return $this->hasMany('App\Screen');
    }
}
