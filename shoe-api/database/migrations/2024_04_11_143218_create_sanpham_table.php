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
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 255);
            $table->decimal('gia', 10, 2);
            $table->foreignId('thuonghieu_id')->constrained("thuonghieu","id");
            $table->text('gioithieu')->nullable();
            $table->string('sanxuat', 50)->nullable();
            $table->decimal('docao', 10, 2)->nullable();
            $table->text('mota')->nullable();
            $table->double('giamgia')->nullable();
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
