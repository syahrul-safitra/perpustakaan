<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('id_buku', 20)->unique();
            $table->string('judul', 100);
            $table->string('penulis', 100);
            $table->date('tahun_terbit');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->integer('stok');
            $table->string('rak');
            $table->timestamps();

            $table->foreignId('category_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
