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
        Schema::create('thesis_panelists', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('id');
            $table->smallInteger('thesis_id')->unsigned()->index();
            $table->foreign('thesis_id')->references('id')->on('theses')->onDelete('cascade');
            $table->smallInteger('panelist_id')->unsigned()->index();
            $table->foreign('panelist_id')->references('id')->on('names')->onDelete('cascade');
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
        Schema::dropIfExists('thesis_panelists');
    }
};
