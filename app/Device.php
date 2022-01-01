<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Device extends Model
{
    protected $fillable = [
        'display_name', 'product_reference', 'description', 'location', 'channel_id'
    ];
    public function user ()
    {
        return $this->belongsTo('App\User');
    }
    public function channel ()
    {
        return $this->belongsTo('App\Channel');
    }
}
