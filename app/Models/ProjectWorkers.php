<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectWorkers extends Model
{
    protected $table="project_workers";
    protected $fillable=["project_id","employee_id"];
}
