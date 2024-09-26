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
        Schema::create("products", function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string("stock_keeping_unit")->unique()->nullable();
            $table->unsignedBigInteger("api_id")->unique();
            $table->unsignedBigInteger("categorie_id")->index()->default(1);
            $table->string("name");
            $table->longText("description");
            $table->double("price");
            $table->integer("supply")->default(1);
            $table->string("img_src");
            $table->string("color");
            $table->string("height_cm");
            $table->string("width_cm");
            $table->string("depth_cm");
            $table->string("weight_gr");
            $table->timestamps();

            $table->foreign("categorie_id")->references("id")->on("categories")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("products");
    }
};
