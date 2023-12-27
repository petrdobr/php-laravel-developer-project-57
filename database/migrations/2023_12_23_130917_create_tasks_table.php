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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('created_by_id');
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->string('assigned_to_id');
            $table->foreign('assigned_to_id')->references('id')->on('users');
            $table->string('status_id');
            $table->foreign('status_id')->references('id')->on('task_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
