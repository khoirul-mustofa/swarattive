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
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('payment_status', ['unpaid', 'dp_paid', 'fully_paid', 'expired', 'failed'])->default('unpaid')->after('status');
            $table->index('payment_status');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->string('external_id')->nullable()->after('booking_id');
            $table->string('snap_token')->nullable()->after('external_id');
            $table->string('payment_url')->nullable()->after('snap_token');
            $table->index('external_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['external_id', 'snap_token', 'payment_url']);
        });
    }
};
