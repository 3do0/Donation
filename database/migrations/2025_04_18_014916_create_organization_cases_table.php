<?php

use App\Models\OrganizationUser;
use App\Models\User;
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
        Schema::create('organization_cases', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(20250001)->primary();
            $table->foreignIdFor(OrganizationUser::class)->constrained()->onDelete('cascade');
            $table->string('case_name');
            $table->string('case_photo')->nullable();
            $table->string('case_file')->nullable();
            $table->string('case_type');
            $table->integer('beneficiaries_count')->nullable();
            $table->text('description')->nullable();
            $table->integer('visitors_count')->default(0);
            $table->string('currency')->default('ريال يمني');
            $table->decimal('target_amount', 10, 2);
            $table->decimal('raised_amount', 10, 2)->default(0);
            $table->enum('status', ['in_progress', 'stopped', 'completed' , 'expired'])->default('in_progress');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_cases');
    }
};
