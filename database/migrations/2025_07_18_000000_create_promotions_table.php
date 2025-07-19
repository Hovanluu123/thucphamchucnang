<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique(); // Mã giảm giá
            $table->string('title', 255); // Tên chương trình
            $table->text('description')->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable(); // Số tiền giảm
            $table->integer('discount_percent')->nullable(); // % giảm
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
}; 