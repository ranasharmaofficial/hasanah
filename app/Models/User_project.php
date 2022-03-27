<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_project extends Model
{
    use HasFactory;
    protected $primaryKey   =   'id';

    protected $fillable = [ 
        'project_id', 
        'user_id'
    ];
}