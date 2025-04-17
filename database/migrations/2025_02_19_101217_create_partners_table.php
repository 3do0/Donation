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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('address')->nullable();
            $table->enum('type', ['individual', 'company', 'government'])->default('company'); 
            $table->text('support_details'); 
            $table->decimal('donation_amount', 15, 2)->nullable(); 
            $table->string('contract_file')->nullable(); 
            $table->date('start_date')->nullable(); 
            $table->date('end_date')->nullable(); 
            $table->boolean('status')->default(false); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
