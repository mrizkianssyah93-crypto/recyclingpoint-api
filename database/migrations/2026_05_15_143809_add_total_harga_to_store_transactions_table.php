<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'store_transactions',
            function (Blueprint $table)
            {
                $table->bigInteger(
                    'total_harga'
                )->default(0);
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'store_transactions',
            function (Blueprint $table)
            {
                $table->dropColumn(
                    'total_harga'
                );
            }
        );
    }
};