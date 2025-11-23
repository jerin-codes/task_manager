<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('project_tasks', function (Blueprint $table) {
        $table->string('status')->default("to_do");
        // or modify existing columns
        // $table->string('description', 500)->change();
    });
}

public function down()
{
    Schema::table('project_tasks', function (Blueprint $table) {
        $table->dropColumn('new_column');
    });
}

};
