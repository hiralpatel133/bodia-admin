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
        Schema::create('restaurant', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 255);
            $table->string('branch_name', 255)->nullable();
            $table->bigInteger('mobile');
            $table->string('username', 100);
            $table->string('password', 255);
            $table->text('address');
            $table->string('state', 255);
            $table->string('city', 255);
            $table->decimal('rating', 10, 2)->default(0.00);
            $table->string('type', 100)->nullable()->comment('1=Veg,2=Nonveg,3=Vegan,4=all');
            $table->integer('minimum_order')->default(0);
            $table->string('latitude', 200)->nullable();
            $table->string('longitude', 200)->nullable();
            $table->decimal('area_kilometers', 10, 1)->default(0.0);
            $table->integer('status')->default(0);
            $table->text('image')->nullable();
            $table->text('cover_image')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->text('other_desc')->nullable();
            $table->string('prepare_time', 100)->nullable();
            $table->integer('minimum_order_amount')->default(0);
            $table->integer('is_open')->default(1);
            $table->text('close_note')->nullable();
            $table->integer('gst_type')->default(0)->comment('1=Include,2=Exclude');
            $table->string('gst', 100)->default('0');
            $table->string('other_charges', 100)->default('0');
            $table->integer('deli_fee_type')->default(0)->comment('1=Fixed,2=Caping,0=Free');
            $table->string('deli_fee_amount', 100)->default('0');
            $table->text('deli_caping_amount');
            $table->integer('provide_self_pickup')->default(0);
            $table->integer('self_pickup_discount')->default(0);
            $table->string('self_pickup_time', 100)->nullable();
            $table->integer('schedule_day')->default(0);
            $table->string('schedule_time1_start', 255)->default('0');
            $table->string('schedule_time1_end', 255)->default('0');
            $table->string('schedule_time2_start', 255)->default('0');
            $table->string('schedule_time2_end', 255)->default('0');
            $table->integer('is_cod')->default(0);
            $table->integer('in_slider')->default(0);
            $table->integer('in_trending')->default(0);
            $table->integer('in_eateries')->default(0);
            $table->integer('is_in_collection')->default(0);
            $table->integer('allow_product')->default(0);
            $table->text('token')->nullable();
            $table->text('token_app')->nullable();
            $table->string('days', 255)->nullable();
            $table->string('open_time1', 45)->nullable();
            $table->string('close_time1', 45)->nullable();
            $table->string('close_note1', 45)->nullable();
            $table->string('open_time2', 45)->nullable();
            $table->string('close_time2', 45)->nullable();
            $table->string('close_note2', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant');
    }
};
