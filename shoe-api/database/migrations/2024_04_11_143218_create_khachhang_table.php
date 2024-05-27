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
        Schema::create('khachhang', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 100);
            $table->string('diachi', 255);
            $table->string('sdt', 20);
            $table->string('email', 100);
            $table->timestamp('thoigian')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('matkhau', 255);
            $table->string('anhdaidien', 255);
            $table->enum('tinhtrang', ['hoatdong', 'vohieuhoa'])->default('hoatdong');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khachhang');
    }
};
