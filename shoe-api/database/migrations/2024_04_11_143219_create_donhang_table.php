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
        Schema::create('donhang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('khachhang_id')->constrained("khachhang","id")->onDelete('cascade');
            $table->string('ten', 100);
            $table->string('diachi', 255);
            $table->string('sdt', 20);
            $table->string('pttt', 100);
            $table->string('tinhtrang', 255);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donhang');
    }
};
