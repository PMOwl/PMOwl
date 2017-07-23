<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id');
            $table->integer('question_id');
            $table->text('body');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
