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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_address');
            $table->string('customer_city');
            $table->string('customer_zip');
            $table->string('customer_country');
            $table->decimal('total', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'customer_address',
                'customer_city',
                'customer_zip',
                'customer_country',
                'total',
            ]);
        });
    }
};
