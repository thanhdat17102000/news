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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('link');
        Schema::dropIfExists('post');
        Schema::dropIfExists('category');

        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->text('short_description');
            $table->text('content');
            $table->timestamps();
        });
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->boolean('statusCrawl')->default(0);
        });
        Schema::create('link', function (Blueprint $table) {
            $table->increments('id');
            $table->text('link');
            $table->boolean('statusCrawl')->default(0);
            $table->integer('idCategory');
            $table->foreign('idCategory')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::enableForeignKeyConstraints();
    }
};
