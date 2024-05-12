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
        Schema::create('resanction_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requistable_id');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('year_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('requistable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resanction_requests');
    }
};
