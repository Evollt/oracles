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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('symbol')->nullable();
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('nfts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('token_id');
            $table->string('opensea_link');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->unsignedBigInteger('contract_id');
            $table->timestamps();

            $table->foreign('image_id')->references('id')->on('files');
            $table->foreign('contract_id')->references('id')->on('contracts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nfts');
        Schema::dropIfExists('contracts');
    }
};
