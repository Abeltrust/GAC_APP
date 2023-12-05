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
        Schema::create('set_payments', function (Blueprint $table) {
            $table->id();
            $table->string('year')->unique();
            $table->string('branch')->nullable()->default(0);
            $table->string('idcard')->nullable()->default(0);
            $table->string('insurance')->nullable()->default(0);
            $table->string('total')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_payments');
    }
};
