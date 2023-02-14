<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('name');
            $table->string('avatar');
            $table->string('discord_avatar');
            $table->string('discord_id');
            $table->string('steam_avatar')->nullable()->default(null);
            $table->string('steam_id')->nullable()->default(null);
            $table->string('teamspeak_id')->nullable()->default(null);
            $table->string('teamspeak_key')->nullable()->default(null);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
