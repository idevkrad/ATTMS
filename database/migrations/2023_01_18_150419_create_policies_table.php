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
        Schema::create('policies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyIncrements('id');
            $table->text('description');
            $table->boolean('is_borrowable')->default(0);
            $table->integer('borrow_count')->default(0);
            $table->string('borrow_time',20)->nullable();
            $table->boolean('is_viewable')->default(0);
            $table->integer('view_count')->default(0);
            $table->string('view_time',20)->nullable();
            $table->tinyInteger('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('policies');
    }
};
