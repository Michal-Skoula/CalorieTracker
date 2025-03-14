<?php

namespace App\Enums;

use App\Models\User;
use App\Traits\EnumToArray;
use Illuminate\Support\Facades\Auth;

enum WeightChangeGoal: string
{
	use EnumToArray;
    case Bulking = 'bulking';
	case Cutting = 'cutting';
	case Maintaining = 'maintaining';

	public function getName(): string
	{
		return match($this) {
			WeightChangeGoal::Bulking 		=> 'Bulking',
			WeightChangeGoal::Cutting 		=> 'Cutting',
			WeightChangeGoal::Maintaining 	=> 'Maintaining'
		};
	}

	public function getColor(): string
	{
		return match($this) {
			WeightChangeGoal::Bulking 		=> 'purple',
			WeightChangeGoal::Cutting 		=> 'yellow',
			WeightChangeGoal::Maintaining 	=> 'gray'
		};
	}


	/**
	 * @param  User|null $user Optionally provide a user model. returns the currently authenticated user by default.
	 * @return string
	 */
	public static function getCurrentGoal(User $user = null): string
	{
		return !$user
			? Auth::user()->settings()->first()->weight_change_goal->value
			: $user->settings()->first()->weight_change_goal->value;
	}
}
