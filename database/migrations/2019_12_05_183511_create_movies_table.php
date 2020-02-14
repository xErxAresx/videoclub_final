<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('title');
            $table->String('year', 8);
            $table->String('director', 64);
            $table->String('poster');
            $table->boolean('rented')->default(false);
            $table->text('synopsis');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->String('trailer')->nullable();
            $table->timestamps();
        });

        Schema::table('movies', function ($table)
        {
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
