<?php

namespace App\Http\Controllers;

class AddMealController extends Controller
{
    public function view()
	{
		$data = '';
		return view('app.meal.add', compact('data'));
	}

	public function store()
	{

	}
}
