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
        // Tabel tanpa foreign key dibuat terlebih dahulu
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->rememberToken();
            $table->enum('jabatan', ['admin', 'apoteker', 'karyawan', 'kasir', 'pemilik', 'kurir']);
            $table->timestamps();
        });

        Schema::create('jenis_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_kirim', ['ekonomi', 'kargo', 'regular', 'same day', 'standar']);
            $table->string('nama_ekspedisi', 255);
            $table->string('logo_ekspedisi', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan', 255);
            $table->string('email', 255);
            $table->string('katakunci', 255); // Ubah panjang ke 255 untuk bcrypt
            $table->string('no_telp', 15)->nullable();
            $table->string('alamat1', 255)->nullable(); // Ubah jadi nullable
            $table->string('kota1', 255)->nullable();   // Ubah jadi nullable
            $table->string('propinsi1', 255)->nullable(); // Ubah jadi nullable
            $table->string('kodepos1', 255)->nullable();  // Ubah jadi nullable
            $table->string('alamat2', 255)->nullable();
            $table->string('kota2', 255)->nullable();
            $table->string('propinsi2', 255)->nullable();
            $table->string('kodepos2', 255)->nullable();
            $table->string('alamat3', 255)->nullable();
            $table->string('kota3', 255)->nullable();
            $table->string('propinsi3', 255)->nullable();
            $table->string('kodepos3', 255)->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('url_ktp', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('metode_bayar', function (Blueprint $table) {
            $table->id();
            $table->string('metode_pembayaran');
            $table->string('tempat_bayar', 50);
            $table->string('no_rekening', 25);
            $table->text('url_logo')->nullable();
            $table->timestamps();
        });

        Schema::create('jenis_obat', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 50);
            $table->string('deskripsi_jenis', 255)->nullable();
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('distributor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_distributor', 50);
            $table->string('telepon', 15)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->timestamps();
        });

        // Tabel dengan foreign key dibuat setelah tabel referensi
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_metode_bayar')->constrained('metode_bayar')->onDelete('cascade');
            $table->date('tgl_penjualan');
            $table->string('url_resep', 255)->nullable();
            $table->decimal('ongkos_kirim', 10, 2)->default(0);
            $table->decimal('biaya_app', 10, 2)->default(0);
            $table->decimal('total_bayar', 10, 2)->default(0);
            $table->enum('status_order', [
                'Menunggu Konfirmasi',
                'Diproses',
                'Menunggu Kurir',
                'Dibatalkan Pembeli',
                'Dibatalkan Penjual',
                'Bermasalah',
                'Selesai'
            ])->default('Menunggu Konfirmasi');
            $table->string('keterangan_status', 255)->nullable();
            $table->foreignId('id_jenis_kirim')->constrained('jenis_pengiriman')->onDelete('cascade');
            $table->foreignId('id_pelanggan')->constrained('pelanggan')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat', 100);
            $table->foreignId('id_jenis_obat')->constrained('jenis_obat')->onDelete('cascade');
            $table->integer('harga_jual');
            $table->text('deskripsi_obat')->nullable();
            $table->string('foto1', 255)->nullable();
            $table->string('foto2', 255)->nullable();
            $table->string('foto3', 255)->nullable();
            $table->integer('stok');
            $table->timestamps();
        });

        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('nonota', 100);
            $table->date('tgl_pembelian');
            $table->decimal('total_bayar', 10, 2);
            $table->foreignId('id_distributor')->constrained('distributor')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjualan')->constrained('penjualan')->onDelete('cascade');
            $table->string('no_invoice', 255);
            $table->dateTime('tgl_kirim');
            $table->dateTime('tgl_tiba')->nullable();
            $table->enum('status_kirim', ['Sedang Dikirim', 'Tiba Di Tujuan']);
            $table->string('nama_kurir', 30);
            $table->string('telpon_kurir', 15);
            $table->string('bukti_foto', 255)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjualan')->constrained('penjualan')->onDelete('cascade');
            $table->foreignId('id_obat')->constrained('obat')->onDelete('cascade');
            $table->integer('jumlah_beli');
            $table->decimal('harga_beli', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelanggan')->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('id_obat')->constrained('obat')->onDelete('cascade');
            $table->integer('jumlah_order');
            $table->decimal('harga', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_obat')->nullable()->constrained('obat')->onDelete('cascade');
            $table->integer('jumlah_beli');
            $table->decimal('harga_beli', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->foreignId('id_pembelian')->constrained('pembelian')->onDelete('cascade');
            $table->string('nama_obat', 100)->nullable(); // pastikan baris ini ADA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tabel dengan foreign key dihapus terlebih dahulu
        Schema::dropIfExists('detail_pembelian');
        Schema::dropIfExists('keranjang');
        Schema::dropIfExists('detail_penjualan');
        Schema::dropIfExists('pengiriman');
        Schema::dropIfExists('pembelian');
        Schema::dropIfExists('obat');
        Schema::dropIfExists('penjualan');
        // Tabel referensi dihapus setelahnya
        Schema::dropIfExists('distributor');
        Schema::dropIfExists('jenis_obat');
        Schema::dropIfExists('metode_bayar');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('jenis_pengiriman');
        Schema::dropIfExists('users');
    }
};