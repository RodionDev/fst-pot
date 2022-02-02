<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Purifier;
class Screen extends Model
{
    protected $touches = ['channel'];
    protected $fillable = [
        'name', 'description',
        'background_color', 'text_color', 'bg_img_cdn_link', 'overlay_color', 'heading', 'subheading', 'html_block', 'text_block'
    ];
    public function setHtmlBlockAttribute($value)
    {
        $this->attributes['html_block'] = Purifier::clean($value);
    }
    public function channel ()
    {
        return $this->belongsTo('App\Channel');
    }
    public function layout ()
    {
        return $this->belongsTo('App\Layout');
    }
}
