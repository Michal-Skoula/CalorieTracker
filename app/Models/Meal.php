<?php

namespace App\Models;

use App\Enums\MealType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Meal extends Model
{
	protected $fillable = [
		'day_id','image','prompt','name','description','type','calories','protein','carbs','fats'
	];

	protected $casts = [
		'type' => MealType::class
	];

	public function getImageUrl(): string
	{
		// TODO: make this use signed URLs when deploying to s3 or similar

		$user_id = Auth::user()->id;

//		return $disk->temporaryUrl("$user_id/$this->image", now()->addMinutes(5));
		return Storage::disk('meals')->url("$user_id/$this->image");


	}

	public function day(): BelongsTo
	{
		return $this->belongsTo(Day::class);
	}
}
