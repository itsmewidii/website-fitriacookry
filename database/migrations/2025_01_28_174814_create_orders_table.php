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
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name')->nullable();
            $table->integer('shipping_price')->nullable();;
            $table->string('shipping_code')->nullable();;
            $table->string('shipping')->nullable();
            $table->bigInteger('no_whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->integer('total_qty')->nullable();
            $table->integer('total_price')->nullable();
            $table->text('address')->nullable();
            $table->enum('status' , ['PENDING' , 'PROSES' , 'DIKIRIM' , 'SELESAI'])->default('PENDING');
            $table->text('proof_transfer')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
