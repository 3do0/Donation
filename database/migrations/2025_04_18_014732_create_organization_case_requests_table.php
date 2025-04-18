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
        Schema::create('organization_case_requests', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(20250001)->primary();
            $table->foreignIdFor(OrganizationUser::class)->constrained()->onDelete('cascade');
            $table->string('case_name');
            $table->string('case_photo')->nullable();
            $table->string('case_file')->nullable();
            $table->string('case_type');
            $table->integer('beneficiaries_count')->nullable();
            $table->text('description')->nullable();
            $table->string('currency');
            $table->decimal('target_amount', 10, 2);
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('cascade');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_case_requests');
    }
};
