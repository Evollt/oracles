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
        Schema::create('scam_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('color_id')->references('id')->on('colors');
        });

        Schema::create('scam_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('color_id')->references('id')->on('colors');
        });

        Schema::create('scams', function (Blueprint $table) {
            $table->id();
            $table->string('old_title');
            $table->text('old_text');
            $table->string('post_title')->nullable();
            $table->text('post_text')->nullable();
            $table->text('images')->nullable();
            $table->unsignedBigInteger('scam_category_id')->nullable();
            $table->unsignedBigInteger('scam_status_id')->nullable();
            $table->timestamps();

            $table->foreign('scam_status_id')->references('id')->on('scam_statuses');
            $table->foreign('scam_category_id')->references('id')->on('scam_categories');
        });

        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('receive_message');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('discord');
            $table->string('url');
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
        Schema::dropIfExists('bot');
    }
};
