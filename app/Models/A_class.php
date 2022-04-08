<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class A_class extends Model
{
    use HasFactory;
    protected $primaryKey   =   'id';

    protected $fillable = [ 
        'class_name', 
        'amount',
    ];
}