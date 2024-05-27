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
        Schema::create('cuahang', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 100);
            $table->string('diachi', 255);
            $table->string('sdt', 20);
            $table->enum('tinhtrang', ['hoatdong', 'vohieuhoa'])->default('hoatdong');
            $table->string('anhminhhoa', 255);
            $table->text('mota');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuahang');
    }
};
