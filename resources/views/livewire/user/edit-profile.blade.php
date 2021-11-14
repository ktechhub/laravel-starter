<div>
    @if ($messageText != '')
        <div class="alert alert-{{ $alert }}" role="alert">
            <button wire:click="closeAlert" type="button" class="btn btn-sm btn-{{ $alert }}">
                <span aria-hidden="true">X</span>
            </button>
            <strong>{{ $messageText }}</strong>
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="row mb-3">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                Image</label>
            <div class="col-md-8 col-lg-9">
                <img src="{{ $user->image }}" alt="Profile">
                <div class="pt-2">
                    <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i
                            class="bi bi-upload"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                            class="bi bi-trash"></i></a>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="name" name="name" type="text"
                    class="form-control @error('title') is-invalid @enderror" id="name">
                @error('name')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
            <div class="col-md-8 col-lg-9">
                <textarea wire:model="bio" name="bio" class="form-control @error('bio') is-invalid @enderror" id="bio"
                    style="height: 100px"></textarea>
                @error('bio')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="company" class="col-md-4 col-lg-3 col-form-label">Gender</label>
            <div class="col-md-8 col-lg-9">
                <select wire:model="gender" name="gender" id="gender"
                    class="form-control @error('gender') is-invalid @enderror">
                    <option value="" disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
            <div class="col-md-8 col-lg-9">
                <select wire:model="country" id="" class="form-control @error('country') is-invalid @enderror">
                    <option value="Ghana">Select Country</option>
                    @foreach ($countries as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('country')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if ($country)
            <div class="row mb-3">
                <label for="state" class="col-md-4 col-lg-3 col-form-label">State</label>
                <div class="col-md-8 col-lg-9">
                    <select wire:model="state" id="state" class="form-control @error('state') is-invalid @enderror">
                        <option value="Greater Accra">Select State</option>
                        @foreach ($states as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('state')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endif



        <div class="row mb-3">
            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Address</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="address" name="address" type="text"
                    class="form-control @error('address') is-invalid @enderror" id="address">
                @error('address')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="phone" name="phone" type="number"
                    class="form-control @error('phone') is-invalid @enderror" id="phone" value="(233) 123456789">
                @error('phone')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                Profile</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="twitter" name="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter">
                @error('twitter')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                Profile</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="facebook" name="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook">
                @error('facebook')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                Profile</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="instagram" name="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram">
                @error('instagram')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                Profile</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="linkedin" name="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" value="https://linkedin.com/#">
                @error('linkedin')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
