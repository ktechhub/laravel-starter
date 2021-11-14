<div>
    <a wire:click.prevent="create" href="" class="btn btn-primary" >Add Role</a><br><br>
    <input wire:model="searchTerm" type="text" placeholder="Search Role ..." class="form-control bg-white" style="width: 250px"><br>

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
                        <h5 class="modal-title">{{ $roleId ? 'Edit Role' : 'Add New Role' }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="role.display_name" class="col-form-label">
                                    Display Name
                                </label>
                                <input wire:model="role.display_name" type="text" class="form-control @error('role.display_name') is-invalid @enderror" placeholder="Enter display name"/>
                                @error('role.display_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="role.name" class="col-form-label">
                                    Name
                                </label>
                                <input wire:model="role.name" type="text" class="form-control @error('role.name') is-invalid @enderror" placeholder="Enter name" @if ($editItem) disabled @endif />
                                @error('role.name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="role.description" class="col-form-label">
                                   Description
                                </label>
                                <textarea wire:model="role.description" type="text"
                                class="form-control @error('role.description') is-invalid @enderror"/> </textarea>
                                @error('role.description')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ $roleId ? 'Save Changes' : 'Save' }}</button>
                        <button wire:click="close" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <div class="@if ($showForm|| $viewRole ) col-md-8 @else col-md-12 @endif">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Display Name</th>
                                            <th>Name</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($roles as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->display_name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>{{ $item->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <a wire:click.prevent="edit({{ $item->id }})"
                                                    href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a wire:click.prevent="showPreview({{ $item->id }})" href="#" class="btn btn-sm btn-outline-dark">View</a>
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
                                            <th>Display Name</th>
                                            <th>Name</th>
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
                            {{ $roles->render("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div> <!-- card body .// -->
            </div> <!-- card .// -->
        </div>

        @if ($viewRole)
        <div class="col-md-4">
            <div class="col">
                <div class="card card-user">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <h5 class="card-title mt-50">{{ $previewRole->display_name }}</h5>
                        <div class="card-text text-muted">
                            <p class="card-text  text-center">{{ $previewRole->description  ?? '<Description goes here>' }}</p>
                         </div>
                         <p class="mt-5">
                            <a wire:click="close" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" class="card-link">Close</a>
                         </p>
                    </div>
                </div>
            </div> <!-- col.// -->

            <div class="card" >
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Account Information
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <p>
                                            <strong>Display Name:</strong><br>
                                            <p>{{ $previewRole->display_name }}</p>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <p>
                                            <strong>Name:</strong><br>
                                            <p>{{ $previewRole->name }}</p>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <p>
                                            <strong>Account Created At:</strong><br>
                                            <p>{{ date('d-F-Y', strtotime($previewRole->created_at)) ?? 'No Record Found' }}</p>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <p>
                                            <strong>Account Updated At:</strong><br>
                                            <p>{{ date('d-F-Y', strtotime($previewRole->updated_at)) ?? 'No Information Added' }}</p>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <p>
                                            <strong>User:</strong><br>
                                            <p>
                                                @foreach ($previewRole->users as $user)
                                                    <span class="badge bg-success mr-2">{{ $user->username }}</span>
                                                @endforeach
                                            </p>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <p>
                                            <strong>Permissions:</strong><br>
                                            <p>
                                                @foreach ($previewRole->permissions as $permission)
                                                    <span class="badge bg-success mr-2">{{ $permission->display_name }}</span>
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

            <div class="card" >
                <div class="card-header">
                    <h4>
                        Role Permissions Management
                    </h4>
                </div>
                <div class="card-body">

                    <h4>Detach Permissions on Role <a wire:click.prevent="detachAll"
                        href="#" class="btn btn-sm btn-outline-danger">Detach All</a></h4>
                    <form wire:submit.prevent=detachPermissions>
                        <p class="mt-5 mb-5">
                            <button type="submit" class="btn btn-outline-warning">{{ __('Detach Permissions') }}</button>
                        </p>
                        <div class="form-group row">
                            @foreach ($permissions as $perm)
                                @if ($role->hasPermission($perm->name))
                                    <div class="col-lg-6">
                                        <div class="checkbox checkbox-primary">
                                            <input wire:model="detachPermission" id="{{ $perm->name }}" type="checkbox" value="{{ $perm->id }}">
                                            <label for="{{ $perm->name }}">
                                                {{ $perm->display_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <p class="mt-5 mb-5">
                            <button type="submit" class="btn btn-outline-warning">{{ __('Detach Permissions') }}</button>
                        </p>
                    </form>
                    <hr>
                    <h4>Assign Permissions to Role <a wire:click.prevent="assignAll"
                        href="#" class="btn btn-sm btn-outline-dark">Assign All</a></h4>
                    <form wire:submit.prevent=assignPermissions>
                        <p>
                            <button type="submit" class="btn btn-outline-warning">{{ __('Assign Permissions') }}</button>
                        </p> <br>
                        <div class="form-group row">
                            @foreach ($permissions as $perm)
                                @if (!$role->hasPermission($perm->name))
                                    <div class="col-lg-6">
                                        <div class="checkbox checkbox-primary">
                                            <input wire:model="permission" id="{{ $perm->name }}" type="checkbox" value="{{ $perm->id }}">
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
                            <button type="submit" class="btn btn-outline-warning">{{ __('Assign Permissions') }}</button>
                        </p>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
