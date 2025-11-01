<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Company extends Authenticatable
{
    protected $table="companies";

      protected $fillable = [
        'company_name',
        'company_id',
        'password',
    ];

        protected $hidden = [
        'password',
        'remember_token',
    ];

    
}
