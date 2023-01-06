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
        Schema::create('securities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('data_usage')->default(true);
            $table->string('phishing_code')->nullable();
            $table->integer('inactive_timer')->default(30);
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('security')->default(true);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('security_id');
            $table->unsignedBigInteger('notification_id');

            $table->foreign('security_id')->references('id')->on('securities');
            $table->foreign('notification_id')->references('id')->on('notifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('security');
        Schema::dropIfExists('notifications');
    }
};
