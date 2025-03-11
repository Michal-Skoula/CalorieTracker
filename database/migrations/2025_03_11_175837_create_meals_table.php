<?php

use App\Enums\MealType;
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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
			$table->foreignId('day_id')->constrained()->cascadeOnDelete();
			$table->string('image');
			$table->text('prompt')->nullable();

			$table->string('name');
			$table->text('description');
			$table->enum('type', array_column(MealType::cases(), 'value'))->default('unknown');

			$table->integer('calories');
			$table->integer('protein');
			$table->integer('carbs');
			$table->integer('fats');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
