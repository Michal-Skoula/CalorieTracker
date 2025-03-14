<?php

namespace App\Livewire\App;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
	public Collection $days;

	public function mount()
	{
		$this->days = Auth::user()->days()
			->with('meals')
			->orderBy('date','desc')
			->get();
	}

    public function render()
    {
        return view('app.dashboard');
    }
}
