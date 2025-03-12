<?php

use App\Http\Controllers\MealController;
use App\Http\Controllers\SettingsController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\FitnessGoals;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

	Route::prefix('settings')->group(function() {
		Route::get('profile', Profile::class)->name('settings.profile');
		Route::get('password', Password::class)->name('settings.password');
		Route::get('appearance', Appearance::class)->name('settings.appearance');
	});

	Route::get('add', [MealController::class, 'add'])->name('app.meal.add');
	Route::post('add', [MealController::class, 'create'])->name('app.meal.store');

	Route::get('goals', [SettingsController::class, 'form'])->name('app.goals.form');
	Route::patch('goals', [SettingsController::class, 'update'])->name('app.goals.update');

});

require __DIR__.'/auth.php';
