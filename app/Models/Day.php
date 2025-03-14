<?php

namespace App\Models;

use App\Enums\WeightChangeGoal;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Day extends Model
{
	protected $fillable = [
		'user_id','date','weight','calorie_goal','weight_change_goal','calories','protein','fats','carbs'
	];
	protected $casts = [
		'weight_change_goal' => WeightChangeGoal::class
	];
	public function getCalories(): int
	{
		return $this->meals()->sum('calories');
	}

	public function getCarbs(): int
	{
		return $this->meals()->sum('carbs');
	}

	public function getFats(): int
	{
		return $this->meals()->sum('fats');
	}

	public function getProteins(): int
	{
		return $this->meals()->sum('protein');
	}

	public function updateData()
	{
		$this->update([
			'calories' 	=> $this->getCalories(),
			'protein' 	=> $this->getProteins(),
			'carbs' 	=> $this->getCarbs(),
			'fats' 		=> $this->getFats(),
		]);

		echo $this->getCalories();

		return $this;
	}

	public function canBeFormatted($format = 'Y-m-d'): bool
	{
		return Carbon::canBeCreatedFromFormat($this->date,$format);
	}

	public function getSemanticDayName(): string
	{
		if(! $this->canBeFormatted()) {
			throw new InvalidDateException(
				field: 'This day\'s date value is invalid, expected format Y-m-d',
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

	/**
	 * Averages the values for a given measured stat over a select number of days.
	 * If there are less logged days than what is requested, an average is still returned.
	 *
	 * @param int $days How many days should be averaged, starting from the last record and ignoring all days without data.
	 * @param string $type What should be averaged. Options: [calories, protein, carbs, fats]
	 * @return int|float
	 */
	public static function getAvg(string $type, int $days = 7): int|float
	{
		return Auth::user()->days()
			->orderBy('date','desc')
			->limit($days)
			->avg($type);
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
