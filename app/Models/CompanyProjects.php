<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProjects extends Model
{
    protected $table="company_projects";

    protected $fillable=["company_id","project_name","project_head_id","description"];

}
