<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload_comment extends Model
{
    use HasFactory;
    protected $primaryKey   =   'id';
    protected $table = 'upload_comments';
    protected $fillable = [ 
        'employee_id',
        'project_id',
        'contractor_id',
        'image_id',
        'comment',
    ];
}
