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
        Schema::create('driver', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('photo');
            $table->string('mobile_no');
            $table->string('user_name');
            $table->string('password');
            $table->integer('transport_type')->comment('1=Truck,2=Car,3=Bike,4=Bicycle,5=Scooter,6=Walk');
            $table->text('transport_description');
            $table->string('number_plate');
            $table->string('color');
            $table->integer('status')->comment('1=Pending,2=Active,3=Suspended,4=Blocked,5=Expired,6=Denied');
            $table->integer('is_on_duty')->comment('0=off_duty,1=on_duty');
            $table->string('latitude');
            $table->string('longitude');
            $table->text('reject_order');
            $table->text('current_order_assign');
            $table->string('api_login_token');
            $table->string('device_token');
            $table->string('device_type');
            $table->integer('is_deleted');
            $table->dateTime('last_status_change')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver');
    }
};
