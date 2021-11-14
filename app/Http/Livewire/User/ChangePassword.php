<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $user;

    public $messageText = '';
    public $alert = '';

    public $password;
    public $new_password;
    public $new_password_confirm;

    protected $rules = [
        'password' => ['required', 'string', 'min:6'],
        'new_password' => ['required', 'string', 'min:6'],
        'new_password_confirm' => ['required', 'string', 'min:6'],
    ];

    public function render()
    {
        return view('livewire.user.change-password');
    }

    public function updated($key, $value)
    {
        $this->validateOnly($key);
    }

    public function save()
    {
        $this->validate();

        $user = User::find(auth()->id());

        if (!Hash::check($this->password, $user->password)) {
            $this->messageText = 'Current Password is Incorrect!';
            $this->alert = 'danger';
            return back();
        }

        if ($this->new_password !== $this->new_password_confirm) {
            $this->messageText = 'New entered passwords do not match!';
            $this->alert = 'danger';
            return back();
        }

        if ($this->password === $this->new_password) {
            $this->messageText = 'Old and new passwords cannot be the same!';
            $this->alert = 'danger';
            return back();
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->messageText = 'Password changed successfully!';
        $this->alert = 'success';
        $this->password = '';
        $this->new_password = '';
        $this->new_password_confirm = '';
    }

    public function closeAlert()
    {
        $this->messageText = '';
        $this->alert = '';
    }
}
