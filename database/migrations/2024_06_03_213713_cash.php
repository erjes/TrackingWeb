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
        Schema::create('Cash', function (Blueprint $table) {
            $table->id();
            $table->integer('session')->nullable();
            $table->integer('amount');
            $table->integer('spend')->nullable();
            $table->string('purpose')->nullable();
            $table->enum('type',['current','history']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        {
            Schema::dropIfExists('Cash');
        }
    }
};
