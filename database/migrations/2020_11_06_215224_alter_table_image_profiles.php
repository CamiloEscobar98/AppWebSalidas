<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableImageProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_profiles', function (Blueprint $table) {
            $table->unique(['image', 'url'], 'unique_image_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_profiles', function (Blueprint $table) {
            $table->dropUnique('unique_image_profiles');
        });
    }
}
