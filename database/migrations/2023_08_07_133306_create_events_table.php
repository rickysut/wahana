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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('kind');
            $table->string('title');
            $table->string('subtitle');
            $table->string('information')->nullable();
            $table->string('speaker_name')->nullable();
            $table->string('speaker_title')->nullable();
            $table->string('speaker_img')->nullable();
            $table->string('front_image')->nullable();
            $table->timestamp('event_date');
            $table->string('location')->nullable();
            $table->json('slider')->nullable();   
            $table->text('detail')->nullable();
            $table->tinyInteger('is_show')->default(1);
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
        Schema::dropIfExists('events');
    }
};
