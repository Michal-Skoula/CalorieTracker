<?php

namespace App\Http\Controllers;

use App\Enums\WeightChangeGoal;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class SettingsController extends Controller
{
    public function form()
	{
		$settings = Auth::user()->settings()->first();
		$calorie_goal = $settings->calorie_goal;
		$current_weight_modifier = WeightChangeGoal::getCurrentGoal();
		$weight_modifiers = WeightChangeGoal::toAssociativeArray();
		$isChecked = fn($goal) => $goal === WeightChangeGoal::getCurrentGoal() ? 'checked' : '';

		return view('app.goals', compact([
			'calorie_goal',
			'weight_modifiers',
			'isChecked',
			'settings'
		]));
	}

	public function update(Request $request)
	{
		$request->validate([
			'weight_change_goal' => ['required',new Enum(WeightChangeGoal::class)],
			'calorie_goal' => 'required|min:0',
		]);

		$settings = Auth::user()->settings()->first();

		$settings->update([
			'weight_change_goal' 	=> $request->get('weight_change_goal'),
			'calorie_goal' 			=> $request->get('calorie_goal'),
		]);
//		dd('success!');
		return back();
	}
}
