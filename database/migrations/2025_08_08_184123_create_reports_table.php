<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('nameScammer');
            $table->string('phoneScammer');
            $table->string('bankNumber');
            $table->string('bankName');
            $table->string('contentReport');
            $table->json('imagesProof');
            $table->string('nameSender');
            $table->string('phoneSender');
            $table->string('option');
            $table->boolean('approve');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
