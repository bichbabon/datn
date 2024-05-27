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
        Schema::create('giohang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('khachhang_id')->constrained("khachhang","id")->onDelete('cascade');
            $table->foreignId('sanpham_size_mausac_id')->constrained("sanpham_size_mausac","id")->onDelete('cascade');
            $table->integer('soluong');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giohang');
    }
};
