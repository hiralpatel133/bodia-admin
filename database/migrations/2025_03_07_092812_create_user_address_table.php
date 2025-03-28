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
        Schema::create('user_address', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id');
            $table->string('address_type', 10);
            $table->string('address_house_no', 255)->nullable();
            $table->string('address_landmark', 255);
            $table->string('contact_detail', 255)->nullable();
            $table->text('address');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->integer('is_delivery');
            $table->string('alternative_mobile', 45)->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_address');
    }
};
