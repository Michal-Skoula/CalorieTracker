<?php

use App\Enums\WeightChangeGoal;
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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id')->constrained()->cascadeOnDelete();
			$table->date('date');
			$table->integer('calorie_goal')->default(0);
			$table->enum('weight_change_goal', WeightChangeGoal::valuesToArray());

			$table->float('weight')->default(0);
			$table->integer('calories')->default(0);
			$table->integer('fats')->default(0);
			$table->integer('carbs')->default(0);
			$table->integer('protein')->default(0);

			$table->timestamps();

			$table->unique(['user_id','date']);

			$table->index('user_id');
			$table->index('day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
