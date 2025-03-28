<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->bigInteger('phone');
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->text('img');
            $table->integer('otp');
            $table->tinyInteger('is_mob_verify')->default(0);
            $table->tinyInteger('isverify')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->enum('is_deleted_user', ['y', 'n'])->default('n');
            $table->integer('is_location_selected')->default(0);
            $table->text('token');
            $table->string('device_type', 20);
            $table->string('cod_block', 40)->default('0');
            $table->text('id_token');
            $table->integer('signup_type')->comment('1=Regular,2=Google,3=Facebook');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
