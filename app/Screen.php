<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Screen extends Model
{
    protected $fillable = [
        'name', 'description',
        'background_color', 'text_color', 'bg_img_cdn_link', 'bg_img_opacity', 'overlay_color', 'heading', 'subheading', 'html_block'
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
