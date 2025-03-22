<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_stoks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ProdukId');
            $table->integer('JumlahProduk');
            $table->unsignedBigInteger('UsersId');
            $table->timestamps();
        });

        DB::unprepared('
        Create Trigger log_stok
        After Update on produks
        For Each Row
        Begin
            Insert Into log_stoks
            (ProdukId, JumlahProduk, UsersId, created_at)
            Values
            (
                New.id,
                New.Stok - Old.Stok,
                New.Users_id,
                Now()
            );
        End;
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_stoks');
    }
};