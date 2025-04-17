<?php

use App\Models\Organization;
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
        Schema::create('organization_project_requests', function (Blueprint $table) {
           
            $table->bigIncrements('id')->startingValue(20250001)->primary();
            $table->foreignIdFor(OrganizationUser::class)->constrained()->onDelete('cascade');
            $table->string('project_name');
            $table->string('project_photo');
            $table->string('project_file');
            $table->integer('beneficiaries_count');
            $table->text('description')->nullable();
            $table->string('location');
            $table->string('contact_number');
            $table->string('whatsapp_number');
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
        Schema::dropIfExists('organization_project_requests');
    }
};
