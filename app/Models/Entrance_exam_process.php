<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrance_exam_process extends Model
{
    use HasFactory;
    protected $primaryKey   =   'id';
    protected $table = 'entrance_exam_processes';
    protected $fillable = [
        'token_no',
        'class_id',
        'name',
        'email',
        'mobile',
        'country',
        'state',
        'city',
        'pincode',
        'passport_photo',
        'aadhar_card',
        'father_aadhar_card',
        'last_year_exam_marksheet',
        'registration_fee',
    ];
}