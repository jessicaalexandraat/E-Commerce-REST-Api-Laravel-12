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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

    $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Orden que se está pagando
    $table->string('stripe_payment_id')->nullable(); // ID oficial de la transacción en Stripe
    $table->decimal('amount', 10, 2); // Monto cobrado
    $table->string('status')->default('pending'); // Estado del pago: succeeded, failed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
