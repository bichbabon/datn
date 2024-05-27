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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('tendangnhap', 100);
            $table->string('matkhau', 255);
            $table->string('anhdaidien', 255);
            $table->enum('tinhtrang', ['hoatdong', 'vohieuhoa'])->default('hoatdong');
            $table->string('chucvu', 255);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
