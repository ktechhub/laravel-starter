<div>
    <a wire:click.prevent="create" href="" class="btn btn-primary">Add User</a><br><br>
    <input wire:model="searchTerm" type="text" placeholder="Search User ..." class="form-control bg-white" style="width: 250px"><br>

    <div class="row">
        @if ($messageText != '')
            <div class="alert alert-{{ $alert }}" role="alert">
                <button wire:click="closeAlert" type="button" class="btn btn-sm btn-{{ $alert }}">
                    <span aria-hidden="true">X</span>
                </button>
                <strong>{{ $messageText }}</strong>
            </div>
        @endif

        {{-- {{ dd($showForm) }} --}}
        @if ($showForm)
            <div class="col-md-4">
                <div class="card">
                    <form wire:submit.prevent="save">
                        <div class="card-header">
                            <h5 class="modal-title">{{ $userId ? 'Edit User' : 'Add New User' }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">
                                        Name
                                    </label>
                                    <input wire:model="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Full Name" @if ($editItem) disabled @endif />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-form-label">
                                        Username
                                    </label>
                                    <input wire:model="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="Enter username" @if ($editItem) disabled @endif />
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">
                                        Email
                                    </label>
                                    <input wire:model="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter email" @if ($editItem) disabled @endif />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">
                                        @if ($previewUser)
                                        Change
                                        @endif Password
                                    </label>
                                    <input wire:model="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit"
                                class="btn btn-primary">{{ $userId ? 'Save Changes' : 'Save' }}</button>
                            <button wire:click="close" type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="@if ($showForm) col-md-8 @else col-md-12 @endif">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    @foreach ($item->roles as $role)
                                                        <span
                                                            class="badge bg-success mr-2">{{ $role->display_name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                                <td>{{ $item->updated_at->diffForHumans() }}</td>
                                                <td>
                                                    <a wire:click.prevent="edit({{ $item->id }})" href="#"
                                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                                    <a wire:click.prevent="showPreview({{ $item->id }})" href="#"
                                                        class="btn btn-sm btn-outline-dark">View</a>
                                                    @permission('users-delete')
                                                        <button wire:click.prevent="delete({{ $item->id }})"
                                                            onclick="confirm('Are you sure {{ $item->username }}?') || event.stopImmediatePropagation()"
                                                            class="btn btn-sm btn-outline-danger">Delete</button>
                                                        @endpermission
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td></td>
                                                        <td>No Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Roles</th>
                                                    <th>Created</th>
                                                    <th>Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div> <!-- .col// -->
                            </div> <!-- .row // -->
                            <div class="row ">
                                <div class="col-md-12 d-flex justify-content-center ">
                                    {{ $users->render('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div> <!-- card body .// -->
                    </div> <!-- card .// -->
                </div>

                @if ($viewUser)
                    <div class="col-md-12">
                        <div class="col">
                            <div class="card card-user">
                                <div class="card-header">
                                    <a wire:click="close" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                        class="card-link">Close</a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-50">{{ $previewUser->username }}</h5>
                                    <div class="card-text text-muted">
                                        <p class="card-text  text-center">{{ $previewUser->email }}</p>
                                    </div>
                                    <p class="mt-5">
                                    </p>
                                </div>
                            </div>
                        </div> <!-- col.// -->

                        <div class="card">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                            Account Information
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <p>
                                                                <strong>Display Name:</strong><br>
                                                            <p>{{ $previewUser->username }}</p>
                                                            </p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <p>
                                                                <strong>Name:</strong><br>
                                                            <p>{{ $previewUser->name }}</p>
                                                            </p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <p>
                                                                <strong>Account Created At:</strong><br>
                                                            <p>{{ date('d-F-Y', strtotime($previewUser->created_at)) ?? 'No Record Found' }}
                                                            </p>
                                                            </p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <p>
                                                                <strong>Account Updated At:</strong><br>
                                                            <p>{{ date('d-F-Y', strtotime($previewUser->updated_at)) ?? 'No Information Added' }}
                                                            </p>
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-12">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <p>
                                                                <strong>Roles:</strong><br>
                                                            <p>
                                                                @foreach ($previewUser->roles as $role)
                                                                    <span
                                                                        class="badge bg-success mr-2">{{ $role->display_name }}</span>
                                                                @endforeach
                                                            </p>
                                                            </p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <p>
                                                                <strong>Permissions:</strong><br>
                                                            <p>
                                                                @foreach ($previewUser->allPermissions() as $permission)
                                                                    <span
                                                                        class="badge bg-success mr-2">{{ $permission->display_name }}</span>
                                                                @endforeach
                                                            </p>
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($messageText != '')
                            <div class="alert alert-{{ $alert }}" role="alert">
                                <button wire:click="closeAlert" type="button" class="btn btn-sm btn-{{ $alert }}">
                                    <span aria-hidden="true">X</span>
                                </button>
                                <strong>{{ $messageText }}</strong>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    Roles and Permissions Management
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Detach Roles on User <a wire:click.prevent="detachAllRoles" href="#"
                                                class="btn btn-sm btn-outline-danger">Detach All</a></h4>
                                        <form wire:submit.prevent=detachRoles>
                                            <div class="form-group row">
                                                @foreach ($roles as $role)
                                                    @if ($user->hasRole($role->name))
                                                        <div class="col-lg-4">
                                                            <div class="checkbox checkbox-primary">
                                                                <input wire:model="detachRole" id="{{ $role->name }}"
                                                                    type="checkbox" value="{{ $role->id }}">
                                                                <label for="{{ $role->name }}">
                                                                    {{ $role->display_name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <p class="mt-5 mb-5">
                                                <button type="submit"
                                                    class="btn btn-outline-warning">{{ __('Detach Roles') }}</button>
                                            </p>
                                        </form>
                                        <hr>
                                        <h4>Assign Roles to User <a wire:click.prevent="assignAllRoles" href="#"
                                                class="btn btn-sm btn-outline-dark">Assign All</a></h4>
                                        <form wire:submit.prevent=attachRoles>
                                            <div class="form-group row">
                                                @foreach ($roles as $role)
                                                    @if (!$user->hasRole($role->name))
                                                        <div class="col-lg-4">
                                                            <div class="checkbox checkbox-primary">
                                                                <input wire:model="attachRole" id="{{ $role->name }}"
                                                                    type="checkbox" value="{{ $role->id }}">
                                                                <label for="{{ $role->name }}">
                                                                    {{ $role->display_name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <br>
                                            <p>
                                                <button type="submit"
                                                    class="btn btn-outline-warning">{{ __('Assign Roles') }}</button>
                                            </p>
                                        </form>
                                        <hr>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Detach Permissions on User <a wire:click.prevent="detachAll" href="#"
                                                class="btn btn-sm btn-outline-danger">Detach All</a></h4>
                                        <form wire:submit.prevent=detachPermissions>
                                            <p class="mt-5 mb-5">
                                                <button type="submit"
                                                    class="btn btn-outline-warning">{{ __('Detach Permissions') }}</button>
                                            </p>
                                            <div class="form-group row">
                                                @foreach ($permissions as $perm)
                                                    @if ($user->hasPermission($perm->name))
                                                        <div class="col-lg-4">
                                                            <div class="checkbox checkbox-primary">
                                                                <input wire:model="detachPermission" id="{{ $perm->name }}"
                                                                    type="checkbox" value="{{ $perm->id }}">
                                                                <label for="{{ $perm->name }}">
                                                                    {{ $perm->display_name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <p class="mt-5 mb-5">
                                                <button type="submit"
                                                    class="btn btn-outline-warning">{{ __('Detach Permissions') }}</button>
                                            </p>
                                        </form>
                                        <hr>
                                        <h4>Assign Permissions to User <a wire:click.prevent="assignAll" href="#"
                                                class="btn btn-sm btn-outline-dark">Assign All</a></h4>
                                        <form wire:submit.prevent=assignPermissions>
                                            <p>
                                                <button type="submit"
                                                    class="btn btn-outline-warning">{{ __('Assign Permissions') }}</button>
                                            </p> <br>
                                            <div class="form-group row">
                                                @foreach ($permissions as $perm)
                                                    @if (!$user->hasPermission($perm->name))
                                                        <div class="col-lg-4">
                                                            <div class="checkbox checkbox-primary">
                                                                <input wire:model="permission" id="{{ $perm->name }}"
                                                                    type="checkbox" value="{{ $perm->id }}">
                                                                <label for="{{ $perm->name }}">
                                                                    {{ $perm->display_name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <br>
                                            <p>
                                                <button type="submit"
                                                    class="btn btn-outline-warning">{{ __('Assign Permissions') }}</button>
                                            </p>
                                        </form>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
