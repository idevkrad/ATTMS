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
        Schema::create('thesis_hardbounds', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('id');
            $table->string('location');
            $table->boolean('is_borrowable');
            $table->tinyInteger('office_id')->unsigned()->index();
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
            $table->smallInteger('thesis_id')->unsigned()->index();
            $table->foreign('thesis_id')->references('id')->on('theses')->onDelete('cascade');
            $table->boolean('is_available')->default(1);
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
        Schema::dropIfExists('thesis_hardbounds');
    }
};
