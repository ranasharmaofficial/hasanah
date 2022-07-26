<?php

namespace App\Models;
use App\Models\Project_category;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Project_request extends Model
{
    
    public function projectcategory()
    {
        return $this->belongsTo(Project_category::class);
        
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function companies()
    {
        return $this->belongsTo(Company::class);
        
    }
}