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
        Schema::create('day_of_week_point_of_interests', function (Blueprint $table) {
            $table->id();

            $table->foreignId("day_of_week_id")->constrained("day_of_weeks")->onDelete("cascade");
            $table->foreignId("point_of_interest_id")->constrained("point_of_interests")->onDelete("cascade");
            $table->time("first_opening")->nullable();
            $table->time("second_opening")->nullable();
            $table->time("first_closing")->nullable();
            $table->time("second_closing")->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_of_week_point_of_interest');
    }
};
