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
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->dateTime('event_date');
            $table->text('description')->nullable();
            $table->string('place')->nullable();
            $table->string('location')->nullable();
            $table->integer('available_seat')->nullable();
            $table->string('speaker')->nullable();
            $table->string('big_image')->nullable();
            $table->string('small_image')->nullable();
            $table->string('exerpt')->nullable();
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
        Schema::dropIfExists('news');
    }
};
