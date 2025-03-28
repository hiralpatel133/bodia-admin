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
        Schema::create('team', function (Blueprint $table) {
            $table->id('id');
            $table->text('task_description');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('driver_id');
            $table->string('pickup_name', 255);
            $table->string('pickup_contact_number', 15);
            $table->dateTime('pickup_before');
            $table->string('pickup_address', 255);
            $table->string('pickup_drop_name', 255);
            $table->string('pickup_drop_contact_number', 15);
            $table->string('pickup_drop_address', 255);
            $table->string('pickup_latitude', 255);
            $table->string('pickup_longitude', 255);
            $table->string('pickup_drop_latitude', 255);
            $table->string('pickup_drop_longitude', 255);
            $table->integer('status')->comment('0=Pending, 1=Accepted, 2=On the way, 3=Delivered, 4=Cancelled');
            $table->integer('is_deleted');
            $table->timestamp('add_date')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team');
    }
};
