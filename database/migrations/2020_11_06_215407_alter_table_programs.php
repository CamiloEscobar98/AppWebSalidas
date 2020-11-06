<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->foreign('faculty_id', 'fk_faculties_programs')->references('id')->on('faculties')->cascadeOnUpdate()->onDelete('restrict');
            $table->unique(['faculty_id', 'name'], 'unique_programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign('fk_faculties_programs');
            $table->dropUnique('unique_programs');
        });
    }
}
