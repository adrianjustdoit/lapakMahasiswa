<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_guest_reviews', function (Blueprint $table) {
            $table->unique(['product_id', 'email'], 'product_guest_reviews_product_email_unique');
        });
    }

    public function down(): void
    {
        Schema::table('product_guest_reviews', function (Blueprint $table) {
            $table->dropUnique('product_guest_reviews_product_email_unique');
        });
    }
};
