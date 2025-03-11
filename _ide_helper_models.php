<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property float|null $weight
 * @property int $calorie_goal
 * @property string $weight_change_goal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereCalorieGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereWeightChangeGoal($value)
 */
	class Day extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $day_id
 * @property string $image
 * @property string|null $prompt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MealData|null $mealData
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereDayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal wherePrompt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereUpdatedAt($value)
 */
	class Meal extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $meal_id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property int $calories
 * @property int $protein
 * @property int $carbs
 * @property int $fats
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Meal $meal
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereCalories($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereCarbs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereFats($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereMealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereProtein($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MealData whereUpdatedAt($value)
 */
	class MealData extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Day> $days
 * @property-read int|null $days_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

