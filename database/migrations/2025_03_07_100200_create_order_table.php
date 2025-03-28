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
        Schema::create('order', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->longText('items');
            $table->string('coupon_code', 100);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_and_charges', 10, 2);
            $table->decimal('delivery_fees', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('grand_total', 10, 2);
            $table->text('instruction');
            $table->integer('order_option')->comment('1=Delivery, 2=SelfPickup');
            $table->integer('delivery_option')->comment('1=Now, 2=Schedule');
            $table->string('delivery_day', 100);
            $table->date('delivery_date');
            $table->string('delivery_time', 255);
            $table->longText('delivery_address');
            $table->string('delivery_by_driver', 255);
            $table->dateTime('assign_date_time')->nullable();
            $table->integer('payment_mode')->comment('1=gpay, 2=paytm, 3=phonepay, 4=cod');
            $table->dateTime('date');
            $table->integer('status')->comment('0=pending, 1=confirm, 2=preparing, 3=ontheway, 4=delivered, 5=cancelled');
            $table->integer('sub_status');
            $table->time('prepare_time');
            $table->integer('payment_status');
            $table->string('txn_id', 255);
            $table->string('bank_name', 255);
            $table->string('bank_txn_id', 255);
            $table->string('gateway', 255);
            $table->text('resp_msg');
            $table->string('cancel_by', 20);
            $table->integer('is_reviewed');
            $table->string('distance_km', 10)->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->integer('is_display')->default(0);
            $table->dateTime('pay_datetime')->nullable();
            $table->integer('reject_n_driver')->default(0);
            $table->integer('preparation_time');
            $table->integer('total_delivery_time');
            $table->dateTime('preparation_time_added');
            $table->dateTime('tbl_delivery_datetime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
