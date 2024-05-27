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
        Schema::create('danhgia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sanpham_id')->constrained("sanpham","id")->onDelete('cascade');
            $table->foreignId('khachhang_id')->constrained("khachhang","id")->onDelete('cascade');
            $table->integer('tyle');
            $table->text('nhanxet');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhgia');
    }
};
