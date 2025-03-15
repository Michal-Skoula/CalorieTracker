<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use OpenAI\Laravel\Facades\OpenAI;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;

class MealAnalysisService
{
	protected static string $system_prompt = <<<PROMPT
		You are an expert nutritionist. Your job is to analyze the nutritional content of a meal based on the provided picture. The user may also provide a description, which you should factor in when analyzing the meal. If you do not recognize the image provided as food, make the `is_meal` value equal false.   

		Return the data as a JSON object with the following keys:
		- `is_meal`: boolean | Decide if the provided picture is a meal or not
		- `name`: string | Descriptive name of the meal starting with a capital letter. 
		- `description`: string | Summary of what you see in the image, along with the estimated weights (in grams) of the food items. For example, "A medium-sized serving of spaghetti consisting of 100g of spaghetti, 40g of tomato sauce, and a small tomato to the side." If you cannot accurately determine the weight, provide an estimated range or use general terms like "a small portion" or "a large serving. Assume that this description may later be edited to provide more accurate results."
		- `type`: string['breakfast','lunch','dinner','snack','unknown'] | Check which meal type this food is most likely to be. You may also use the background of the meal, such as when it is dark outside you may assume it to be dinner. When unsure, select unknown. you may ONLY use the provided options.
		- `calories`: int |Estimated number of calories in the meal. 
		- `protein` int | Estimated number of protein in the meal.  
		- `carbs`: int | Estimated number of carbs in the meal.  
		- `fats` int |Estimated number of fat in the meal.  
		  
		If you are unsure of a value, leave it as `0` for a number value and `''` for a string.
	PROMPT;

	protected static string $language_specific_prompt = '';

	/**
	 * @param  UploadedFile  $image
	 * @param  string  $prompt
	 * @return array
	 */
	public static function analyze(UploadedFile $image, string $prompt = ''): array
	{
		// static::optimizeImage($image); TODO: fix the optimizations, got stuck on  Spatie\Image\Exceptions\UnsupportedImageFormat:  Unsupported format ``

		$base64_image = static::imageToBase64($image);

		$result = static::callApi($base64_image, $prompt);

		return (array) json_decode($result->choices[0]->message->content);
	}

	protected static function callApi($base64_image, $prompt)
	{
		return OpenAI::chat()->create([
			"model" => "gpt-4o",
			"messages" => [
				[
					"role" => "system",
					"content" => self::$system_prompt . self::$language_specific_prompt,
				],
				[
					"role" => "user",
					"content" => [
						[
							"type" => "image_url",
							"image_url" => [
								"url" => $base64_image,
							]
						],
						[
							"type" => "text",
							"text" => $prompt ?? '',
						]
					]
				]
			],
			"response_format" => ["type" => "json_object"],
			"temperature" => 1,
			"max_completion_tokens" => 2048,
			"top_p" => 1,
			"frequency_penalty" => 0,
			"presence_penalty" => 0,
		]);
	}

	protected static function imageToBase64(UploadedFile $image): string
	{
		$base64 = base64_encode(file_get_contents($image->getRealPath()));
		$mime_type = $image->getMimeType();

		return "data:$mime_type;base64,$base64";
	}

	protected static function optimizeImage(UploadedFile $image): void
	{
		Image::load($image->getRealPath())
			->fit(Fit::FillMax, 400, 300)
			->optimize()
			->save($image->getRealPath());
	}
}