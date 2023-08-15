<?php

use App\Constants\BondConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bonds', function (Blueprint $table) {
            $table->id();
            $table->date('issue_date');
            $table->date('last_circulation_date');
            $table->unsignedFloat('price');
            $table->enum('payment_frequency', BondConstant::PAYMENT_FREQUENCY);
            $table->enum('calculation_period', BondConstant::CALCULATION_PERIOD);
            $table->unsignedFloat('coupon_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bond');
    }
};
