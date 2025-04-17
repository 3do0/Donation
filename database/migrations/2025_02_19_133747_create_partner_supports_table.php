<?php

use App\Models\Partner;
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
        Schema::create('partners_support', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Partner::class)->constrained()->onDelete('cascade'); 
            $table->enum('support_type', ['financial', 'technical', 'logistical'])->default('financial'); 
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('service_provided')->nullable(); // الخدمات المقدمة (في حالة الدعم التقني أو اللوجستي)
            $table->string('receipt')->nullable(); 
            $table->text('notes')->nullable(); 
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('partners_support');
    }
};
