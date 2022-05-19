<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_schedule extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'exam_schedules';
    protected $fillable = [
        'exam_name',
        'school_id',
        'class',
        'exam_date',
        'exam_time_from',
        'exam_time_to',
        'exam_center',
    ];
}
