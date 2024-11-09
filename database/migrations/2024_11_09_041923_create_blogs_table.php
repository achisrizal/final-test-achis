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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // The title of the blog post
            $table->text('content'); // The main content of the blog post
            $table->foreignId('author_id')->constrained('users'); // Foreign key for the author (assuming you have a users table)
            $table->string('slug')->unique(); // URL-friendly version of the title
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // Post status
            $table->timestamp('published_at')->nullable(); // The date/time the blog post was published
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
