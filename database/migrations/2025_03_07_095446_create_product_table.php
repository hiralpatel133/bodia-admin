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
        Schema::create('product', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('resto_id');
            $table->unsignedBigInteger('type');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('name', 255);
            $table->string('short_desc', 255);
            $table->text('long_desc');
            $table->longText('size_list');
            $table->integer('status');
            $table->integer('is_trending');
            $table->text('choice_addon');
            $table->text('trending_image');
            $table->text('video');
            $table->text('video_thumb');
            $table->integer('is_fast_filling');
            $table->integer('is_sold_out');
            $table->integer('must_try');
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
