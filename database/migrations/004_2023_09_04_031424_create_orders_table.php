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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            // $table->unsignedBigInteger('customer_id');
            $table->dateTime('order_date');
            $table->string('order_status');
            $table->timestamps();
            $table->string('customer_name');
            $table->string('customer_phone',30)->nullable();
            $table->string('customer_email');
            $table->string('customer_address')->nullable();
            $table->integer('total');
            $table->json('order_items');


            // $table->foreign('customer_email')->references('email')->on('customers')->onDelete('cascade');
            //  $table->foreign('customer_name')->references('name')->on('customers')->onDelete('cascade');
            // $table->foreign('customer_phone')->references('phone')->on('customers')->onDelete('cascade');
            // $table->foreign('customer_address')->references('address')->on('customers')->onDelete('cascade');
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
