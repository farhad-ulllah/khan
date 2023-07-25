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
        Schema::create('attributesvalue_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('attribute_value_id');
            $table->unsignedBigInteger('product_id');
            $table->string('attribute_value');

            $table->foreign('group_id')
            ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('attribute_value_id')
            ->references('id')->on('attribute_values')->onDelete('cascade');
            $table->foreign('product_id')
            ->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('attributesvalue_values');
    }
};
