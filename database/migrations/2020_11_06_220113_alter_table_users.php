<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('program_id', 'fk_programs_users')->references('id')->on('programs')->cascadeOnUpdate()->onDelete('restrict');
            $table->foreign('document_id', 'fk_documents_users')->references('id')->on('documents')->cascadeOnUpdate()->onDelete('restrict');
            $table->foreign('image_id', 'fk_images_users')->references('id')->on('image_profiles')->cascadeOnUpdate()->onDelete('restrict');
            $table->unique('code', 'unique_code_users');
            $table->unique('emailu', 'unique_emailu_users');
            $table->unique('email', 'unique_email_users');
            $table->unique('phone', 'unique_phone_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('fk_programs_users');
            $table->dropForeign('fk_documents_users');
            $table->dropForeign('fk_images_users');
            $table->dropUnique('unique_code_users');
            $table->dropUnique('unique_emailu_users');
            $table->dropUnique('unique_email_users');
            $table->dropUnique('unique_phone_users');
        });
    }
}
