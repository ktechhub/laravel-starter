<?php

namespace App\Http\Livewire\User;

use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;

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

    public $image;

    protected $rules = [
        'name' => 'required|string|max:100|min:4',
        'bio' => 'required|string|max:300|min:8',
        'gender' => 'required|string|max:100|min:4',
        'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:10000',
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
        $this->validate();
        $user = User::find(auth()->id());
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

    public function uploadImage()
    {
        $user = User::find(auth()->id());

        $this->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:10000',
        ]);

        if ($this->image !== null) {
            $file = $this->image;
            $imageName = time().'.'.$file->getClientOriginalName();
            $img = Image::make($file);
            $img->resize(400, 400);

            $resource = $img->stream()->detach();

            $path = $this->image->storeAs('public/images/users', $imageName);

            $user->image = $imageName;
            $user->image_url = '/storage/images/users/'.$imageName;

            $user->save();

            $this->messageText = 'User profile picture updated successfully!';
            $this->alert = 'success';
            $this->image = '';
        }
    }

    public function deleteImage()
    {
        $user = User::find(auth()->id());

        if ($user->id != Auth::user()->id) {
            $this->messageText = 'You cannot delete for '. $user->username . '!';
            $this->alert = 'danger';
            return back();
        }

        $user->image = "/avatar.png";
        $user->save();

        $this->messageText = 'User profile picture updated successfully!';
        $this->alert = 'success';
    }
}
