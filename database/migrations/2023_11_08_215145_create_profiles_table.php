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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained("users")->cascadeOnDelete();
            $table->string('firstName');
            $table->string('lastName');
            $table->date('birthday')->nullable;
            $table->enum('gender',["Male","Female"])->nullable();
            $table->string("street")->nullable();
            $table->string("city")->nullable();
            $table->string("postalCode")->nullable();
            $table->char("country",2);
            $table->char("language",6)->default("en");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
