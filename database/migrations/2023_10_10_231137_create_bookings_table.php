<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cus_user_id');  // ลูกค้าจาก id
            $table->unsignedBigInteger('concert_id');  // ข้อมูลคอนเสิร์ตจาก id
            $table->unsignedBigInteger('ticket_id');  // ข้อมูลตั๋ว
            $table->integer('quantity');  // จำนวนตั๋ว
            $table->decimal('total_price', 8, 2);  // ราคารวม
            $table->string('qr_code')->nullable();  // QR Code
            $table->timestamps();

            $table->foreign('cus_user_id')->references('id')->on('cus_users')->onDelete('cascade');
            $table->foreign('concert_id')->references('id')->on('concerts')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
