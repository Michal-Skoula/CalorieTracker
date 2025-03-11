<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meal extends Model
{
	protected $fillable = [
		'day_id','image','prompt','name','description','type','calories','protein','carbs','fats'
	];

	public function day(): BelongsTo
	{
		return $this->belongsTo(Day::class);
	}
}
