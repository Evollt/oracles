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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('password');
            $table->dropColumn('remember_token');
            $table->string('email')->nullable()->after('alias')->change();
            $table->text('verification_code')->nullable()->after('email_verified_at');
            $table->string('guid')->after('email')->unique();
            $table->string('discriminator')->nullable()->after('email');
            $table->string('username')->nullable()->after('discriminator');
            $table->string('avatar')->nullable()->after('username');
            $table->string('locale')->nullable()->after('avatar');
            $table->boolean('mfa_enabled')->default(false)->after('locale');
            $table->boolean('verified')->default(false)->after('mfa_enabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
