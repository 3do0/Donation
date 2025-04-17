<?php

use App\Models\Donor;
use App\Models\OrganizationCase;
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
        Schema::create('quick_donations', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(20250501)->primary();
            $table->foreignIdFor(Donor::class)->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(OrganizationCase::class)->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('currency');
            $table->string('visitor_name')->nullable();
            $table->string('visitor_email')->nullable();
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_donations');
    }
};
