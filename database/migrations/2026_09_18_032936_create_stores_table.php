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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();

            // Relasi ke User (Penjual / Seller)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Informasi Profil Toko
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();

            // Berkas Verifikasi Penjual (KTP/NPWP)
            $table->string('ktp_number', 16)->nullable();
            $table->string('ktp_image')->nullable();

            // Status Moderasi Super Admin
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('message')->nullable(); // Alasan jika permohonan toko ditolak

            // Status Operasional & Fitur
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('inactive');
            $table->boolean('is_verified')->default(false); // Centang biru / Official Store

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
