<?php

namespace App\Http\Livewire\User;

use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditProfile extends Component
{
    public $user;

    public $bio;
    public $name;
    public $gender;
    public $country;
    public $state;
    public $address;
    public $phone;
    public $twitter;
    public $facebook;
    public $instagram;
    public $linkedin;
    public $github;

    public $messageText = '';
    public $alert = '';

    protected $rules = [
        'name' => 'required|string|max:100|min:4',
        'bio' => 'required|string|max:300|min:8',
        'gender' => 'required|string|max:100|min:4',
        // 'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:10000',
        'country' => 'required',
        'state' => 'required',
        'address' => 'required|string|max:200|min:5',
        'phone' => 'required|numeric|max:20|min:8',
        'twitter' => 'nullable|string|max:255',
        'facebook' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'linkedin' => 'nullable|string|max:255',
        // 'github' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->bio = $this->user->bio;
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->gender = $this->user->gender;
        $this->country = $this->user->country_id;
        $this->state = $this->user->state_id;
        $this->address = $this->user->address;
        $this->phone = $this->user->phone;
        $this->twitter = $this->user->twitter;
        $this->facebook = $this->user->facebook;
        $this->instagram = $this->user->instagram;
        $this->linkedin = $this->user->linkedin;
        $this->github = $this->user->github;
    }

    public function render()
    {
        $countries = Country::where('active', true)->get();
        $states = State::where('country_id', $this->country)->get();
        return view('livewire.user.edit-profile', compact('countries', 'states'));
    }

    public function updated($key, $value)
    {
        $this->validateOnly($key);
    }

    public function save()
    {
        $user = User::find($this->user->id);
        $user->name = $this->name;
        $user->bio = $this->bio;
        $user->gender = $this->gender;
        $user->country_id = $this->country;
        $user->state_id = $this->state;
        $user->address = $this->address;
        $user->phone = $this->phone;
        $user->twitter = $this->twitter;
        $user->facebook = $this->facebook;
        $user->instagram = $this->instagram;
        $user->linkedin = $this->linkedin;
        // $user->github = $this->github;
        $user->save();

        $this->messageText = 'Profile Updated Successfully';
        $this->alert = 'success';
    }

    public function closeAlert()
    {
        $this->messageText = '';
        $this->alert = '';
    }
}
