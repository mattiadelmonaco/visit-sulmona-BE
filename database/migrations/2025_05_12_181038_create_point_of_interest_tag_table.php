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
        Schema::create('point_of_interest_tags', function (Blueprint $table) {
            $table->id();

            $table->foreignId("point_of_interest_id")->constrained("point_of_interests")->onDelete("cascade");
            $table->foreignId("tag_id")->constrained("tags")->onDelete("cascade");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_of_interest_tag');
    }
};
