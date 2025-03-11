<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
	protected $fillable = [
		'user_id','date','weight','calorie_goal','weight_change_goal'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function meals(): HasMany
	{
		return $this->hasMany(Meal::class);
	}
}
