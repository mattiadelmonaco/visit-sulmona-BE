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
        Schema::create('point_of_interests', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("type_id")->nullable()->constrained("types")->nullOnDelete();
            $table->string("name");
            $table->text("description")->nullable();
            $table->string("address")->nullable();
            $table->decimal("latitude", 10, 8)->nullable();
            $table->decimal("longitude", 11, 8)->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->string("external_link")->nullable();
            $table->string("phone_number")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_of_interest');
    }
};
