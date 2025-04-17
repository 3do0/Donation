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
        Schema::create('donor_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Donor::class)->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('feedbackable_id');
            $table->string('feedbackable_type');
            $table->integer('rating')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_feedback');
    }
};
