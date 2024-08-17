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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->enum('vendor_gender',['male','female','other'])->nullable();
            $table->string('vendor_email')->unique();
            $table->string('vendor_phone')->nullable();
            $table->string('vendor_address')->nullable();
            $table->enum('vendor_role',['owner','manager']);
            $table->string('salon_name'); 
            $table->string('salon_phone');
            $table->string('salon_email')->unique()->nullable();
            $table->string('salon_website')->nullable();
            $table->string('salon_address'); 
            $table->string('salon_city');
            $table->string('salon_state');
            $table->string('salon_country');
            $table->string('salon_postal_code')->nullable();
            $table->date('established_date')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
