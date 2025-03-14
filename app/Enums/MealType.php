<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum MealType: string
{
	use EnumToArray;
    case Breakfast = 'breakfast';
	case Lunch = 'lunch';
	case Dinner = 'dinner';
	case Snack = 'snack';
	case Unknown = 'unknown';

	public function getColor(): string
	{
		return match($this) {
			MealType::Breakfast => 'yellow',
			MealType::Lunch 	=> 'blue',
			MealType::Dinner 	=> 'green',
			MealType::Snack 	=> 'orange',
			MealType::Unknown 	=> 'gray'
		};
	}

	public function getName(): string
	{
		return match($this) {
			MealType::Breakfast => 'Breakfast',
			MealType::Lunch 	=> 'Lunch',
			MealType::Dinner 	=> 'Dinner',
			MealType::Snack 	=> 'Snack',
			MealType::Unknown 	=> 'Unknown'
		};
	}
}
