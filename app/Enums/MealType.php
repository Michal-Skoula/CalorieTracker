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
}
