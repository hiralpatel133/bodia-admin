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
        Schema::create('driver_sub_admin', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('photo');
            $table->string('email')->nullable();
            $table->text('modulespermission')->nullable();
            $table->integer('parent_id')->default(0);
            $table->string('mobile_no');
            $table->string('user_name');
            $table->string('password');
            $table->integer('transport_type')->comment('1=Truck,2=Car,3=Bike,4=Bicycle,5=Scooter,6=Walk');
            $table->text('transport_description');
            $table->string('number_plate');
            $table->string('color');
            $table->integer('status')->comment('1=Pending,2=Active,3=Suspended,4=Blocked,5=Expired,6=Denied');
            $table->string('api_login_token');
            $table->string('device_token');
            $table->string('device_type');
            $table->integer('is_deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_sub_admin');
    }
};
