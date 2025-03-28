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
        Schema::create('subject', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('rest_id');
            $table->string('title', 255);
            $table->integer('status');
            $table->string('start_time', 45)->nullable();
            $table->string('end_time', 45)->nullable();
            $table->string('start_time2', 45)->nullable();
            $table->string('end_time2', 45)->nullable();
            $table->integer('is_deleted')->default(0);
            $table->timestamp('created_date')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};
