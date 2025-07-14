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
        Schema::create('flutter_payments', function (Blueprint $table) {
            $table->id();
            $table->string('tx_ref');
            $table->string('email');
            $table->string('name');
            $table->string('phone');
            $table->string('amount');
            $table->string('currency');
            $table->string('quantity');
            $table->enum('status',['pending','successful','failed','cancelled']);
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flutter_payments');
    }
};
