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
        if (!Schema::hasColumn('project_tasks', 'status')) {
            $table->string('status')->default('to_do');
        }
    });
}

public function down()
{
    Schema::table('project_tasks', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
