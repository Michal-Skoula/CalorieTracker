<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Meal;
use App\Services\MealAnalysisService;
use Error;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function add()
	{
		return view('app.meal.add');
	}

	public function edit()
	{
		return view('app.meal.edit');
	}

	public function create(Request $request)
	{
		$request->validate([
			'day' => 'required|date|before_or_equal:today',
			'image' => 'image|mimes:jpeg,jpg,png,webp,gif|required',
			'prompt' => 'nullable|string',
		]);


		if(Day::where('date', $request->get('day'))->doesntExist()) {
			Day::create([
				'user_id' => auth()->user()->id,
				'date' => $request->get('day'),
				'calorie_goal' => 0, //TODO: make this based off of settings
				'weight_change_goal' => 'cutting', //TODO: make this based off of user settings
			]);
		}

		try {
			$image_base64 = MealAnalysisService::imageToBase64($request->file('image'));

			$response = MealAnalysisService::analyse($image_base64, $request->get('prompt') ?? '');
		}
		catch(Error) {
			return back()->withErrors([
				'image' => 'Something went wrong when processing the image'
			]);
		}

		if($response['is_meal']) {
			Meal::create([
				'day_id' 		=> Day::where('date', $request->get('day'))->first()->id,
				'image' 		=> $request->file('image')->hashName(),
				'prompt' 		=> $request->get('prompt') ?? '',

				'name' 			=> $response['name'],
				'type' 			=> $response['type'],
				'description' 	=> $response['description'],
				'calories' 		=> $response['calories'],
				'protein' 		=> $response['protein'],
				'carbs' 		=> $response['carbs'],
				'fats' 			=> $response['fats']
			]);

			$request->file('image')->store(
				path: auth()->user()->id, // Each user has their own directory
				options: 'meals' // This is the disk name
			);
		}
		else {
			return back()->withErrors([
				'image' => 'The provided image was not recognized as food'
			]);
		}

		return redirect()->route('dashboard');

	}
}
