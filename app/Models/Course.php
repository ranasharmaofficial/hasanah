<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $primaryKey   =   'id';

    protected $fillable = [ 
        'course_id', 
        'courseName', 
        'courseTitle',
        'courseDetails',
        'courseImage'
    ];
    protected static function boot(){
        parent::boot();
        static::created(function ($coursepost) {
            $coursepost->slug = $coursepost->generateSlug($coursepost->courseTitle);
            $coursepost->save();
        });
    }

    private function generateSlug($course){
        if (static::whereSlug($slug = Str::slug($course))->exists()) {
            $max = static::whereCourseTitle($course)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}
