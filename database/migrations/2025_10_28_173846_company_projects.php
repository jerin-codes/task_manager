<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('company_projects', function (Blueprint $table) {
            $table->id();
            $table->string("company_id");
            $table->string("project_name");
             $table->string("project_head");
            $table->string("description");
            $table->integer("employee_count")->nullable();
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
