<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_login_history extends Model
{
    use HasFactory;
    protected $primaryKey   =   'id';

    protected $fillable = [ 
        'user_id', 
        'ip_address'
    ];
}