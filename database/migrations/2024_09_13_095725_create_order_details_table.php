<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->string('orderId');
            $table->string('itemCode');
            $table->integer('buyQty');
            $table->decimal('total', 10, 2);

            // Composite primary key
            $table->primary(['orderId', 'itemCode']);

            // Foreign key constraints
            $table->foreign('orderId')->references('orderId')->on('orders')->onDelete('cascade');
            $table->foreign('itemCode')->references('code')->on('items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
