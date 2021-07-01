<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsTable extends Migration
{
    public function up(): void
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained('treatments');
            $table->string('generic', 100);
            $table->string('trade', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
}
