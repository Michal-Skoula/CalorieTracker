<?php

namespace App\Services;

use App\Models\Day;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealCreationService
{

	public function __construct(
		protected Request $request
	) {}

	public function validateRequest(): void
	{
		$this->request->validate([
			'date' => 'required|date|before_or_equal:today',
			'image' => 'image|mimes:jpeg,jpg,png,webp,gif|required',
			'prompt' => 'nullable|string',
		]);
	}

	public function createDay(): void
	{
		Day::create([
			'user_id' 				=> auth()->user()->id,
			'date' 					=> $this->request->get('date'),
			'calorie_goal' 			=> auth()->user()->settings()->first()->calorie_goal ?? 0,
			'weight_change_goal' 	=> auth()->user()->settings()->first()->weight_change_goal ?? 'cutting',
		]);
	}
	public function createMeal(array $response): void
	{
		$day = Day::where('date', $this->request->get('date'))->first();

		Meal::create([
			'day_id' 		=> $day->id,
			'image' 		=> $this->request->file('image')->hashName(),
			'prompt' 		=> $this->request->get('prompt') ?? '',

			'name' 			=> $response['name'],
			'type' 			=> $response['type'],
			'description' 	=> $response['description'],
			'calories' 		=> $response['calories'],
			'protein' 		=> $response['protein'],
			'carbs' 		=> $response['carbs'],
			'fats' 			=> $response['fats']
		]);

		$day->updateData();

		$this->request->file('image')->store(
			path: auth()->user()->id, // Each user has their own directory
			options: 'meals' // This is the disk name
		);

	}
}