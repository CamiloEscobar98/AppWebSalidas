<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true); // PK
            $table->unsignedMediumInteger('teacher_id');
            $table->unsignedBigInteger('address_id')->nullable(); // FK
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('place');
            $table->date('date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
