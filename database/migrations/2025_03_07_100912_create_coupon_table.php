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
        Schema::create('coupon', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('resto_id');
            $table->string('title', 100);
            $table->string('code', 100);
            $table->date('from');
            $table->date('to');
            $table->string('start_time', 100);
            $table->string('end_time', 100);
            $table->integer('status');
            $table->integer('condition_amount');
            $table->string('discount_type', 11);
            $table->integer('discount_amount');
            $table->integer('discount_perce');
            $table->integer('max');
            $table->integer('no_of_total_instance');
            $table->integer('no_of_user');
            $table->integer('total_used');
            $table->integer('applicable_on')->default(1)->comment('1=Delivery, 2=SelfPickup, 3=Both');
            $table->timestamps();

            $table->foreign('id')->references('id')->on('restaurant')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon');
    }
};
