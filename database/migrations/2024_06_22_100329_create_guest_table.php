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
            $table->string('eventid')->nullable();
            $table->string('eventname')->nullable();
            $table->string('salutations');
            $table->string('name')->nullable();
            $table->string('organization');
            $table->string('address')->nullable();
            $table->string('contactNumber')->nullable();
            $table->string('email')->nullable();
            $table->string('guesttype')->nullable();
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
