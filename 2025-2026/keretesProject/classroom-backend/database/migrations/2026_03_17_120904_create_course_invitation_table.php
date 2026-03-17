<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("course_invitation", function (Blueprint $table) {
            $table->id();
            $table->foreignId("courses_id")->constrained("courses")->cascadeOnDelete();
            $table->string("code", 10)->unique();
            $table->timestamp("created_at")->current();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("course_invitation");
    }
};
