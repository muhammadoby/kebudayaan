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
        Schema::create('event_comment_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('culture_id')->constrained('cultures', 'id')->onDelete('cascade')->nullable();
            $table->foreignId('culture_comment_id')->constrained('culture_comments', 'id')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->text('report');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_comment_reports');
    }
};
