<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('commissions', function (Blueprint $table) {
    //         $table->id();
    //         $table->decimal('rate', 5, 2);
    //         $table->unsignedBigInteger('course_id');
    //         $table->timestamps();

    //         $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
    //     });
    // }


    public function up(): void
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->decimal('rate', 5, 2);
            $table->unsignedBigInteger('teacher_id');
            $table->string('session_fee');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
