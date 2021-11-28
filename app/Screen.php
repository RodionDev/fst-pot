<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Screen extends Model
{
    public function channel ()
    {
        return $this->belongsTo('App\Channel');
    }
    public function layout ()
    {
        return $this->belongsTo('App\Layout');
    }
}
