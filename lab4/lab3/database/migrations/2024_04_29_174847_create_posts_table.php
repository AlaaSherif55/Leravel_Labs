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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); 
            $table->string('title');
            $table->string('body');
            $table->string('image')->nullable();//NOT NULL migrate ===>up 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */ //MAKE MIGRATION ===> MY
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
