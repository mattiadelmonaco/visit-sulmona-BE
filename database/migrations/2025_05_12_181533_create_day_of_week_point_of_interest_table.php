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
        Schema::create('day_of_week_point_of_interest', function (Blueprint $table) {
            $table->id();

            $table->foreignId("day_of_week_id")->constrained("days_of_week")->onDelete("cascade");
            $table->foreignId("point_of_interest_id")->constrained("points_of_interest")->onDelete("cascade");
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
