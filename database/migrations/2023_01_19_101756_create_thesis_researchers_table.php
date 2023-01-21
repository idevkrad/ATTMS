<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_researchers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('id');
            $table->smallInteger('thesis_id')->unsigned()->index();
            $table->foreign('thesis_id')->references('id')->on('theses')->onDelete('cascade');
            $table->smallInteger('researcher_id')->unsigned()->index();
            $table->foreign('researcher_id')->references('id')->on('names')->onDelete('cascade');
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
        Schema::dropIfExists('thesis_researchers');
    }
};
