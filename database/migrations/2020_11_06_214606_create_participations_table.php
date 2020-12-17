<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->unsignedMediumInteger('user_id');
            $table->unsignedTinyInteger('role_id')->nullable(true);
            $table->boolean('approved')->default(1);
            $table->boolean('assist')->default(0);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::table('participations', function (Blueprint $table) {
            $table->foreign('activity_id', 'fk_activities_participations')->references('id')->on('activities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('user_id', 'fk_users_participations')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('role_id', 'fk_role_participations')->references('id')->on('role_activities')->cascadeOnUpdate()->onDelete('set null');
            $table->unique(['activity_id', 'user_id'], 'unique_participations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->dropForeign('fk_activities_participations');
            $table->dropForeign('fk_users_participations');
            $table->dropForeign('fk_role_participations');
            $table->dropUnique('unique_participations');
        });
        Schema::dropIfExists('participations');
    }
}
