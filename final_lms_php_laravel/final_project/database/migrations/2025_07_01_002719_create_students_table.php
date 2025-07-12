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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
                 $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');



            $table->string('college');

            $table->string('degree');
    $table->foreignId('group_id')->references('id')->on('groups');

        // العلاقة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
