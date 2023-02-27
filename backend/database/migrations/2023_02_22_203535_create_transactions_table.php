<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->text('title', 50)->nullable();
            $table->text('description', 255)->nullable();
            // $table->string('typeCode')->default('expenses');
            $table->unsignedDecimal('amount')->nullable();
            $table->string('schedule')->nullable();
            $table->date('startDate');
            $table->date('endDate')->nullable();
            $table->string('status')->default('unpaid');
            $table->timestamps();
            $table->parentId()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};