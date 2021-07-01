<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneInfoTable extends Migration
{
    public function up(): void
    {
        Schema::create('gene_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained('treatments');
            $table->string('gene', 100);
            $table->string('genotype', 100);
            $table->string('phenotype', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gene_info');
    }
}
