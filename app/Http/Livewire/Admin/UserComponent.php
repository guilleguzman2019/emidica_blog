<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Notifications\NewUserNotification;
use App\Models\User;

class UserComponent extends Component
{

    public $user, $name, $email, $user_type, $nameEdit, $emailEdit, $user_typeEdit;

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function save()
    {
        $this -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'user_type' => 'required'
        ]);

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = substr(str_shuffle($permitted_chars), 0, 8);

        $user = User::create([
            'name' => $this -> name,
            'email' => $this -> email,
            'user_type' => $this -> user_type,
            'password' => Hash::make($password),
            'state' => 1,
        ]);

        $user -> notify( new NewUserNotification( $user -> name, $user -> email, $password ) );

        $this -> reset('name', 'email', 'user_type');
        $this -> emit('saved');
    }

    public function edit(User $user)
    {
        $this -> user = $user;
        $this -> nameEdit = $user -> name;
        $this -> emailEdit = $user -> email;
        $this -> user_typeEdit = $user -> user_type;
    }

    public function update()
    {
        $this -> validate([
            'nameEdit' => 'required',
            'emailEdit' => 'required|email|unique:users,email,' . $this -> user -> id,
            'user_typeEdit' => 'required'
        ]);

        $this -> user -> update([
            'name' => $this -> nameEdit,
            'email' => $this -> emailEdit,
            'user_type' => $this -> user_typeEdit,
        ]);

        $this -> reset('nameEdit', 'emailEdit', 'user_typeEdit');
        $this -> emit('updated');
    }

    public function destroy(User $user)
    {
        $user -> delete();
        $this -> emit('deleted');
    }

    public function render()
    {
        $users = User::whereNotIn('user_type', [4]) -> orderBy('id', 'DESC') -> get();
        return view('livewire.admin.user-component', compact('users'));
    }
}
