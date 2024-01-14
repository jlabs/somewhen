<?php

use App\Models\Author;
use App\Models\Location;
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
        Schema::create('moments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(Location::class)->constrained();
            $table->foreignIdFor(Author::class)->constrained();
            $table->string('source')->nullable();
            $table->dateTime('date_taken')->nullable();
            $table->string('image')->nullable();
            $table->string('direction')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moments');
    }
};
