<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('document_type_id', 'fk_document_type_documents')->references('id')->on('document_types')->cascadeOnUpdate()->onDelete('restrict');
            $table->unique(['document_type_id', 'document'], 'unique_documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign('fk_document_type_documents');
            $table->dropUnique('unique_documents');
        });
    }
}
