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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('eventid')->nullable(); //$table->foreignIdFor(Event::class);
            $table->string('eventname')->nullable(); // x perlu kalau buat foreign id ke event $table->foreignIdFor(Event::class);
            $table->string('salutations')->default('Mr');
            $table->string('name')->nullable();
            $table->string('organization')->nullable();
            $table->string('address')->nullable();
            $table->string('contactNumber')->nullable();
            $table->string('email')->nullable();
            $table->string('guesttype')->nullable(); //guestcategory
            $table->string('bringrep')->nullable();;
            $table->string('attendance')->nullable();
            $table->string('checkedin')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
