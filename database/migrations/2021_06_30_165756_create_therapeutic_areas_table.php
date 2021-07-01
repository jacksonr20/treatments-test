<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTherapeuticAreasTable extends Migration
{
    public function up(): void
    {
        Schema::create('therapeutic_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained('treatments');
            $table->string('name', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('therapeutic_areas');
    }
}
