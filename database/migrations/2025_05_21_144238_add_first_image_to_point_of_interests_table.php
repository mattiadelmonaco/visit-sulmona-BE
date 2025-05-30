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
        Schema::table('point_of_interests', function (Blueprint $table) {
            $table->text("first_image")->nullable()->after("email");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('point_of_interests', function (Blueprint $table) {
            $table->dropColumn("first_image");
        });
    }
};
