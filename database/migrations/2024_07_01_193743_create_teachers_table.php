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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobile_user_id');
            $table->string('name');
            $table->string('role');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('dob');
            $table->string('profile_pict')->nullable();
            $table->timestamps();

            $table->foreign('mobile_user_id')->references('id')->on('mobile_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
