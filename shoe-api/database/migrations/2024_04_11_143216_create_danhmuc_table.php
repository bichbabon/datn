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
        Schema::create('danhmuc', function (Blueprint $table) {
            $table->id(); // Tự động tạo cột id INT PRIMARY KEY AUTO_INCREMENT
            $table->string('ten', 255); // Cột 'ten' kiểu VARCHAR(255)
            $table->timestamps(); // Tự động tạo cột 'created_at' và 'updated_at' kiểu TIMESTAMP
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhmuc');
    }
};
