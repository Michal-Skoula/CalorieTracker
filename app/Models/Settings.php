<?php

namespace App\Models;

use App\Enums\WeightChangeGoal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settings extends Model
{
	protected $fillable = [
		'user_id','calorie_goal','weight_change_goal'
	];

	protected $casts = [
		'weight_change_goal' => WeightChangeGoal::class,
	];

    public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
