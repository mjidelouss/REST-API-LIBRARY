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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 30)->nullable(false);
            $table->string('author')->nullable(false);
            $table->string('collection')->nullable(false);
            $table->string('isbn')->nullable(false);
            $table->unsignedBigInteger('genre_id');
            $table->integer('pages');
            $table->string('status')->nullable(false);
            $table->string('position')->nullable(false);
            $table->string('content')->nullable(false);
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');

            $table->date('published_at')->nullable(false);
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
        Schema::dropIfExists('books');
    }
};
