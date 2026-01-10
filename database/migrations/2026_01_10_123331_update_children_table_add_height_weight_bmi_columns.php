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
        Schema::table('children', function (Blueprint $table) {
            $table->decimal('height',25,2)->default('0.00')->nullable()->after('birthdate')->index();
            $table->decimal('weight',25,2)->default('0.00')->nullable()->after('height')->index();
            $table->decimal('bmi',25,2)->default('0.00')->nullable()->after('weight')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn(['height','weight','bmi']);
        });
    }
};
