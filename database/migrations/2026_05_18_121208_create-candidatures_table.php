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
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('company_name');
            $table->string('job_title');
            $table->string('offer_url')->nullable();
            $table->enum('status', ['envoyée', 'en_attente', 'entretien', 'offre', 'refusée']);
            $table->enum('priority', ['basse', 'moyenne', 'haute']);
            $table->text('notes')->nullable();
            $table->date('application_date');
            $table->string('attachment')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
