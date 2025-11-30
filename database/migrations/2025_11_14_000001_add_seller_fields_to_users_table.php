<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Seller profile fields
            $table->string('shop_name')->nullable();
            $table->text('shop_description')->nullable();
            $table->string('pic_name')->nullable(); // Person in Charge
            $table->string('pic_phone', 30)->nullable();
            $table->string('pic_email')->nullable();
            $table->text('pic_address')->nullable();
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('pic_id_number', 50)->nullable();
            $table->string('pic_id_photo_path')->nullable();
            $table->string('pic_photo_path')->nullable();

            // Verification status: pending, approved, rejected
            $table->enum('seller_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->string('activation_token', 64)->nullable()->index();
            $table->boolean('is_admin')->default(false)->index();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'shop_name',
                'shop_description',
                'pic_name',
                'pic_phone',
                'pic_email',
                'pic_address',
                'rt',
                'rw',
                'kelurahan',
                'kecamatan',
                'kota',
                'provinsi',
                'pic_id_number',
                'pic_id_photo_path',
                'pic_photo_path',
                'seller_status',
                'rejection_reason',
                'activation_token',
                'is_admin',
            ]);
        });
    }
};
