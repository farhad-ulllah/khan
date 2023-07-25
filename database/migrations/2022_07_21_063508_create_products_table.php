<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->bigInteger('orignal_price')->nullable();
            $table->bigInteger('selling_price')->nullable();
            $table->unsignedBigInteger('cat_id');
            $table->string('small_description')->nullable();
            $table->bigInteger('qty')->nullable();
            $table->bigInteger('tax')->nullable();
            $table->string('status');
            $table->string('trending');
            $table->string('image');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();;
            $table->string('tags')->nullable();
            $table->string('upcoming')->nullable();
            $table->string('popular')->nullable();
            $table->string('alt_image')->nullable();
            // $table->json('product_attributes')->nullable();
            $table->unsignedBigInteger('brand_id');
            $table->string('video_host')->nullable();
            $table->string('video_link')->nullable();
            $table->unsignedBigInteger('click_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
