<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->foreign('teacher_id', 'fk_teachers_activities')->references('id')->on('users')->cascadeOnUpdate()->onDelete('restrict');
            $table->unique('title', 'unique_activities');
        });

        Schema::table('requirements', function (Blueprint $table) {
            $table->foreign('activity_id', 'fk_activities_requirements')->references('id')->on('activities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique('text', 'unique_requirements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign('fk_teachers_activities');
            $table->dropUnique('unique_activities');
        });

        Schema::table('requirements', function (Blueprint $table) {
            $table->dropForeign('fk_activities_requirements');
            $table->dropUnique('unique_requirements');
        });
    }
}
