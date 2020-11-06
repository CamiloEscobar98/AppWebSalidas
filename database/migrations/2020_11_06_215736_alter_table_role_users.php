<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRoleUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_users', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_users_role_users')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('role_id', 'fk_roles_role_users')->references('id')->on('roles')->cascadeOnUpdate()->onDelete('restrict');
            $table->unique(['role_id', 'user_id'], 'unique_role_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_users', function (Blueprint $table) {
            $table->dropForeign('fk_users_role_users');
            $table->dropForeign('fk_roles_role_users');
            $table->dropUnique('unique_role_users');
        });
    }
}
