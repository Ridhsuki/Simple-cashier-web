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
        Schema::create('bayars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PenjualanId');
            $table->date('TanggalBayar');
            $table->decimal('TotalBayar', 10, 2);
            $table->decimal('Kembalian', 10, 2);
            $table->string('StatusBayar');
            $table->Enum('JenisBayar',['Cash', 'Transfer'])->default('Cash');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayars');
    }
};
