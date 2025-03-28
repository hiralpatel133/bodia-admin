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
        Schema::create('task', function (Blueprint $table) {
            $table->id('id'); // Auto-incrementing primary key
            $table->text('task_description');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('driver_id');
            $table->string('pickup_name');
            $table->string('pickup_contact_number', 15);
            $table->dateTime('pickup_before');
            $table->string('pickup_address');
            $table->string('pickup_drop_name');
            $table->string('pickup_drop_contact_number', 15);
            $table->string('pickup_drop_address');
            $table->string('pickup_latitude');
            $table->string('pickup_longitude');
            $table->string('pickup_drop_latitude');
            $table->string('pickup_drop_longitude');
            $table->enum('status', ['0', '1', '2', '3', '4'])->default('0'); // 0=Pending, 1=Accepted, 2=On the way, 3=Delivered, 4=Cancelled
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
