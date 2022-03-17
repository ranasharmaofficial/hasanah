<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply_project extends Model
{
    use HasFactory;
    protected $primaryKey   =   'id';

    protected $fillable = [ 
        'project_id', 
        'user_id'
    ];
}