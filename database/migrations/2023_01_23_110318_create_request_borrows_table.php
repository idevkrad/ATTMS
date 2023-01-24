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
        Schema::create('request_borrows', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('id');
            $table->string('remarks')->nullable();
            $table->boolean('is_out');
            $table->boolean('is_lost')->default(0);
            $table->boolean('is_returned')->default(0);
            $table->smallInteger('hardbound_id')->unsigned()->index();
            $table->foreign('hardbound_id')->references('id')->on('thesis_hardbounds')->onDelete('cascade');
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
        Schema::dropIfExists('request_borrows');
    }
};
