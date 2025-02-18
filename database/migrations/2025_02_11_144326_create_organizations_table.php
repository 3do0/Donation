<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(202501001)->primary();
            $table->string('name');
            $table->string('logo');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('address');
            $table->string('city');
            $table->text('activity_type');
            $table->string('registration_number')->unique();
            $table->string('bank_name');
            $table->string('bank_account_number')->unique();
            $table->string('license');
            $table->string('web_url')->unique()->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
