<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('description');
            $table->decimal('unitPrice', 10, 2);
            $table->integer('qtyOnHand');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
