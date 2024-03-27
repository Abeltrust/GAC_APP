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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('unitPrice');
            $table->string('status');
            $table->string('quantity');
            $table->string('total');
            $table->string('deduct_monthly');
            $table->date('start_month');
            $table->timestamp('last_deduction')->nullable();
            $table->string('applied_by');
            $table->string('approved_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
