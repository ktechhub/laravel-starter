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
            <label for="password" class="col-md-4 col-lg-3 col-form-label">Current
                Password</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">

                @error('password')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New
                Password</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="new_password" name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password">

                @error('new_password')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="new_password_confirm" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                Password</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="new_password_confirm" name="new_password_confirm" type="password" class="form-control @error('new_password_confirm') is-invalid @enderror" id="new_password_confirm">

                @error('new_password_confirm')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger">Change Password</button>
        </div>
    </form>
</div>
