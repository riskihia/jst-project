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
        Schema::create('polas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('target', [1, -1])->default(1);
            $table->integer('bias')->default(1);
            
            $table->integer('tabel_id');
            $table->integer('cell_id');
            $table->foreign('tabel_id')->references('id')->on('tabels')->onDelete('cascade');
            $table->foreign('cell_id')->references('id')->on('cells')->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polas');
    }
};
