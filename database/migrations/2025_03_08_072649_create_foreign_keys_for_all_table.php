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
        Schema::table('applied_user_coupon', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupon')->onDelete('cascade');
            $table->foreign('resto_id')->references('id')->on('restaurant')->onDelete('cascade');
        });

        Schema::table('branch_schedule_time', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('restaurant_branch')->onDelete('cascade');
        });

        Schema::table('collection', function (Blueprint $table) {
            $table->foreign('restro_id')->references('id')->on('restaurant')->onDelete('cascade');
        });

        Schema::table('coupon', function (Blueprint $table) {
            $table->foreign('resto_id')->references('id')->on('restaurant')->onDelete('cascade');
        });

        Schema::table('driver_sub_admin', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('driver')->onDelete('cascade');
        });

        Schema::table('order', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurant')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('restaurant_branch')->onDelete('cascade');
        });

        Schema::table('order_chat', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
        });

        Schema::table('party_chat', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('payment_detail', function (Blueprint $table) {
            $table->foreign('order_id_db')->references('id')->on('order')->onDelete('cascade');
        });

        Schema::table('product', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('resto_id')->references('id')->on('restaurant')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subject')->onDelete('cascade');
        });

        Schema::table('product_image', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });

        Schema::table('restaurant_branch', function (Blueprint $table) {
            $table->foreign('resto_id')->references('id')->on('restaurant')->onDelete('cascade');
        });

        Schema::table('restaurant_device_token', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('restaurant_schedule_time', function (Blueprint $table) {
            $table->foreign('resto_id')->references('id')->on('restaurant')->onDelete('cascade');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->foreign('resto_id')->references('id')->on('restaurant')->onDelete('cascade');
        });

        Schema::table('slider', function (Blueprint $table) {
            $table->foreign('resto_id')->references('id')->on('restaurant')->onDelete('cascade');
        });

        Schema::table('subject', function (Blueprint $table) {
            $table->foreign('rest_id')->references('id')->on('restaurant')->onDelete('cascade');
        });

        Schema::table('task', function (Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('team')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('driver')->onDelete('cascade');
        });

        Schema::table('team_driver', function (Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('team')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('driver')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applied_user_coupon', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['order_id']);
            $table->dropForeign(['coupon_id']);
            $table->dropForeign(['resto_id']);
        });

        Schema::table('branch_schedule_time', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
        });

        Schema::table('collection', function (Blueprint $table) {
            $table->dropForeign(['restro_id']);
        });

        Schema::table('coupon', function (Blueprint $table) {
            $table->dropForeign(['resto_id']);
        });

        Schema::table('driver_sub_admin', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });

        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['restaurant_id']);
            $table->dropForeign(['branch_id']);
        });

        Schema::table('order_chat', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('payment_detail', function (Blueprint $table) {
            $table->dropForeign(['order_id_db']);
        });

        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['resto_id']);
            $table->dropForeign(['subject_id']);
        });

        Schema::table('product_image', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::table('restaurant_branch', function (Blueprint $table) {
            $table->dropForeign(['restro_id']);
        });

        Schema::table('restaurant_device_token', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['order_id']);
            $table->dropForeign(['resto_id']);
        });

        Schema::table('slider', function (Blueprint $table) {
            $table->dropForeign(['restro_id']);
        });

        Schema::table('subject', function (Blueprint $table) {
            $table->dropForeign(['rest_id']);
        });

        Schema::table('task', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropForeign(['driver_id']);
        });

        Schema::table('team_driver', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropForeign(['driver_id']);
        });
    }
};
