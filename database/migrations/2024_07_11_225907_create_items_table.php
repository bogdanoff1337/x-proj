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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('icon_url')->nullable();
            $table->string('assetid');
            $table->string('classid');
            $table->string('instanceid');
            $table->string('market_hash_name');
            $table->string('name');
            $table->decimal('steam_price', 10, 2)->nullable();
            $table->string('type')->nullable();
            $table->string('float')->nullable();
            $table->json('stickers')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
