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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('year');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_candidates');
    }
};
