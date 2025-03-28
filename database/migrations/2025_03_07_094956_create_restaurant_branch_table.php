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
        Schema::create('restaurant_branch', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('resto_id');
            $table->string('branch_name', 255);
            $table->integer('minimum_order');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->decimal('area_kilometers', 10, 1);
            $table->integer('status');
            $table->text('short_desc');
            $table->text('long_desc');
            $table->text('other_desc');
            $table->text('image');
            $table->text('cover_image');
            $table->text('video');
            $table->text('video_thumb');
            $table->text('cover_video');
            $table->text('c_video_thumb');
            $table->string('prepare_time', 100);
            $table->integer('minimum_order_amount');
            $table->integer('gst_type');
            $table->string('gst', 100);
            $table->string('other_charges', 100);
            $table->integer('deli_fee_type');
            $table->text('deli_caping_amount');
            $table->integer('provide_self_pickup');
            $table->integer('self_pickup_discount');
            $table->string('self_pickup_time', 100);
            $table->string('schedule_day', 100);
            $table->string('schedule_time1_start', 100);
            $table->string('schedule_time1_end', 100);
            $table->string('schedule_time2_start', 100);
            $table->string('schedule_time2_end', 100);
            $table->integer('is_cod');
            $table->string('deli_fee_amount', 45);
            $table->integer('is_delivery');
            $table->integer('visit_restro')->nullable();
            $table->date('current_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_branch');
    }
};
