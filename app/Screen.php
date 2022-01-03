<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Screen extends Model
{
    protected $fillable = [
        'name', 'description'
    ];
    public function channel ()
    {
        return $this->belongsTo('App\Channel');
    }
    public function layout ()
    {
        return $this->belongsTo('App\Layout');
    }
}
