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
        Schema::create('organization_projects', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(20250001)->primary();
            $table->foreignIdFor(OrganizationUser::class)->constrained()->onDelete('cascade');
            $table->string('project_name');
            $table->string('project_photo')->nullable();
            $table->string('project_file')->nullable();
            $table->string('project_type')->default('عينية');
            $table->integer('beneficiaries_count')->nullable();
            $table->text('description')->nullable();
            $table->string('location');
            $table->integer('visitors_count')->default(0);
            $table->enum('status', ['in_progress', 'stopped', 'expired'])->default('in_progress');
            $table->string('contact_number')->nullable();
            $table->string('whatsapp_number')->nullable();
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
        Schema::dropIfExists('organization_projects');
    }
};
