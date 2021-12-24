<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_group_id');
            $table->string('title');
            // $table->enum('is_active', ['true', 'false'])->default('true');
            $table->boolean('is_active')->default(1);
            $table->enum('priority', ['very-high', 'high', 'medium', 'low', 'very-low'])->default('very-high');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('activity_group_id')->references('id')->on('activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
