<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Customer', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            // $table->enum('customer_type',['sender', 'recipient']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Customer');
    }
};
