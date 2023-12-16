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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 50);
            $table->string('author', 30);
            $table->year('year');
            $table->string('publisher', 50);
            $table->string('city', 10);
            $table->string('cover', 50);
            $table->uuid('bookshelf_id');
            $table->foreign('bookshelf_id')
                ->references('id')
                ->on('bookshelfs')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
