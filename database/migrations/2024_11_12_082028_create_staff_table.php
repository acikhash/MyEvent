<?php

use App\Models\Department;
use App\Models\Gred;
use App\Models\Major;
use App\Models\Title;
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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(Title::class); //salutation
            $table->string('name');
            $table->foreignIdFor(Department::class);
            $table->string('department');
            $table->foreignIdFor(Major::class);
            $table->string('major');
            $table->foreignIdFor(Gred::class);
            $table->string('gred');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
