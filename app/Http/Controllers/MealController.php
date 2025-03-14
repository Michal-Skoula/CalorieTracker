<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Services\MealAnalysisService;
use App\Services\MealCreationService;
use Exception;
use Illuminate\Http\Request;
use Log;
use OpenAI\Exceptions\TransporterException;

class MealController extends Controller
{
    public function add()
	{
		return view('app.meal');
	}

	public function edit()
	{
		return view('app.meal.edit');
	}

	public function create(Request $request)
	{
		$meal_service = new MealCreationService($request);

		$meal_service->validateRequest();

		if(Day::where('date', $request->get('date'))->doesntExist()) {
			$meal_service->createDay();
		}

		try {
			$response = MealAnalysisService::analyze(
				image: $request->file('image'),
				prompt: $request->get('prompt') ?? ''
			);
		}
		catch(TransporterException $e)
		{
			return back()->withErrors([
				'image' => 'There was an issue processing the request, please check your internet connection or try again later.'
			]);
		}
		catch(Exception $e)
		{
			Log::error("Something went wrong when Accessing the OpenAI service: {$e->getMessage()}");
			return back()->withErrors([
				'image' => 'Something went wrong when processing the image. Please try again later.'
			]);
		}

		if(! $response['is_meal']) {
			return back()->withErrors([
				'image' => 'The provided image was not recognized as food'
			]);
		}

		$meal_service->createMeal($response);

		return redirect()->route('dashboard');
	}
}
