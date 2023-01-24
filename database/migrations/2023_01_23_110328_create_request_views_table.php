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
        Schema::create('request_views', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('id');
            $table->boolean('is_closed')->default(0);
            $table->smallInteger('thesis_id')->unsigned()->index();
            $table->foreign('thesis_id')->references('id')->on('theses')->onDelete('cascade');
            $table->smallInteger('request_id')->unsigned()->index();
            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
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
        Schema::dropIfExists('request_views');
    }
};
