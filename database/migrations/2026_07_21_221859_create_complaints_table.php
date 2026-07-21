<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_category_id')->constrained()->cascadeOnDelete();
            $table->string('nomor_tiket')->unique();
            $table->string('judul');
            $table->string('nama_pelapor');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->string('status')->default('baru')->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
