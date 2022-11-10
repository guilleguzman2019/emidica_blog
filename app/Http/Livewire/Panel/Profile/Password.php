<?php

namespace App\Http\Livewire\Panel\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Password extends Component
{

	public $current_password, $password, $password_confirmation;

	public function savePassword()
	{
		$this -> validate([
			'current_password' => ['required', function ($attribute, $value, $fail) {
				if (!\Hash::check($value, Auth::user()->password)) {
					return $fail(__('The current password is incorrect.'));
				}
			}],
			'password' => 'required',
			'password_confirmation' => 'required|same:password'
		]);

		Auth::user() -> password = Hash::make($this -> password);
		Auth::user() -> save();

		$this -> reset('current_password', 'password', 'password_confirmation');
		$this -> emit('updated');
	}

	public function render()
	{
		return view('livewire.panel.profile.password');
	}
}
