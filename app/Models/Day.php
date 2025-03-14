<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
	protected $fillable = [
		'user_id','date','weight','calorie_goal','weight_change_goal'
	];

	public function canBeFormatted($format = 'Y-m-d'): bool
	{
		return Carbon::canBeCreatedFromFormat($this->date,$format);
	}

	public function getSemanticDayName(): string
	{
		if(! $this->canBeFormatted()) {
			throw new InvalidDateException(
				field: "This day\'s date value is invalid, expected format 'Y-m-d'",
				value: $this->date,
				code: 500
			);
		}

		$date = Carbon::createFromFormat('Y-m-d', $this->date)->startOfDay(); // gets the date without h:m:s

		return match((int)$date->diffInDays(today())) {
			0 => 'Today',
			1 => 'Yesterday',
			2, 3, 4, 5, 6, 7, 8 => $date->dayName,
			default => $date->format('d.m.Y'),
		};
	}

	public function getFormattedDay(): string
	{
		if(! $this->canBeFormatted()) {
			throw new InvalidDateException(
				field: 'This day\'s date value is invalid, expected format Y-m-d',
				value: $this->date,
				code: 500
			);
		}

		return Carbon::createFromFormat('Y-m-d', $this->date)->format('d.m.Y');
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function meals(): HasMany
	{
		return $this->hasMany(Meal::class);
	}
}
