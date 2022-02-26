<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $primaryKey   =   'id';
    protected $table = 'events';
    protected $fillable = [ 
        'eventID', 
        'eventName', 
        'eventTitle',
        'eventDetails',
        'eventImage'
    ];
    protected static function boot(){
        parent::boot();
        static::created(function ($addevent) {
            $addevent->slug = $addevent->generateSlug($addevent->eventTitle);
            $addevent->save();
        });
    }

    private function generateSlug($eventadd){
        if (static::whereSlug($slug = Str::slug($eventadd))->exists()) {
            $max = static::where('eventTitle',$eventadd)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug = Str::slug($eventadd);
    }
}
