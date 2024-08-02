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
        Schema::create('message_attachements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained('messages');
            $table->string('name', 255); //x2DdkhhUkdfhj.jpg
            $table->string('path',  1024); // /image/x2DdkhhUkdfhj.jpg
            $table->string('mime', 255); //jpg, png, xsl
            $table->integer('seize'); //jpg, png, xsl
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_attachements');
    }
};
