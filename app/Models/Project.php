<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class Project extends Model
{
    use HasFactory;
    public function pro_category(){
        return $this->hasOne('App\Models\Project_category', 'project_cat_id', 'project_cat');
    }
    public function get_company_name(){
        return $this->hasOne('App\Models\Company', 'company_id', 'company_id');
    }
    // public function get_distributor_name(){
    //     return $this->hasOne('App\Models\Distributor', 'company_id', 'company_id');
    // }
}