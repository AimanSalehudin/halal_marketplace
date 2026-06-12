<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_name')->nullable()->after('id');
            $table->string('customer_email')->nullable()->after('customer_name');
            $table->integer('quantity')->default(1)->after('price');
            $table->string('status')->default('completed')->after('quantity');
            $table->string('vendor_name')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'customer_email', 'quantity', 'status', 'vendor_name']);
        });
    }
};
