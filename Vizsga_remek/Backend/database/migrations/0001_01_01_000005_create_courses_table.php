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
        Schema::create("courses", function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->text("description");
            $table->foreignId("course_type_id")->constrained("course_type");
            $table->foreignId("teacher_id")->constrained("users");
            $table->integer("max_students")->default(100);
            $table->integer("students_number");
            $table->timestamp("created_at")->current();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("courses");
    }
};
