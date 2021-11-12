<div>
    <a wire:click.prevent="create" href="" class="btn btn-primary" >Add Permission</a><br><br>
    <input wire:model="searchTerm" type="text" placeholder="Search Permission ..." class="form-control align-content-md-end" style="width: 250px"><br>

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
        <div class="col-md-3">
            <div class="card">
                <form wire:submit.prevent="save">
                    <div class="card-header">
                        <h5 class="modal-title">{{ $permissionId ? 'Edit Permission' : 'Add New Permission' }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="permission.display_name" class="col-form-label">
                                    Display Name
                                </label>
                                <input wire:model="permission.display_name" type="text" class="form-control @error('permission.display_name') is-invalid @enderror" placeholder="Enter display name"/>
                                @error('permission.display_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="permission.name" class="col-form-label">
                                    Name
                                </label>
                                <input wire:model="permission.name" type="text" class="form-control @error('permission.name') is-invalid @enderror" placeholder="Enter name" @if ($editItem) disabled @endif />
                                @error('permission.name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="permission.description" class="col-form-label">
                                   Description
                                </label>
                                <textarea wire:model="permission.description" type="text"
                                class="form-control @error('permission.description') is-invalid @enderror"/> </textarea>
                                @error('permission.description')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ $permissionId ? 'Save Changes' : 'Save' }}</button>
                        <button wire:click="close" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <div class="@if ($showForm|| $viewPermission ) col-md-9 @else col-md-12 @endif">
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
                                        @forelse ($permissions as $item)
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
                            {{ $permissions->render("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div> <!-- card body .// -->
            </div> <!-- card .// -->
        </div>

        @if ($viewPermission)
        <div class="col-md-3">
            <div class="col">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title text-center">{{ $previewPermission->display_name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-text text-muted">
                            <p class="card-text text-center">{{ $previewPermission->description  ?? '<Description goes here>' }}</p>
                         </div>
                    </div>
                </div>
            </div> <!-- col.// -->

            <div class="card">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Information
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <p>
                                            <strong>Display Name:</strong><br>
                                            <p>{{ $previewPermission->display_name }}</p>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <p>
                                            <strong>Name:</strong><br>
                                            <p>{{ $previewPermission->name }}</p>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <p>
                                            <strong>Roles:</strong><br>
                                            <p>
                                                @foreach ($previewPermission->roles as $role)
                                                    <span class="badge bg-success mr-2">{{ $role->display_name }}</span>
                                                @endforeach
                                            </p>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <p>
                                            <strong>User:</strong><br>
                                            <p>
                                                @foreach ($previewPermission->users as $user)
                                                    <span class="badge bg-success mr-2">{{ $user->username }}</span>
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

            <div class="card">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                         Setup
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p>
                                        <strong>Created At:</strong><br>
                                        <p>{{ date('d-F-Y', strtotime($previewPermission->created_at)) ?? 'No Record Found' }}</p>
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p>
                                        <strong>Updated At:</strong><br>
                                        <p>{{ date('d-F-Y', strtotime($previewPermission->updated_at)) ?? 'No Information Added' }}</p>
                                    </p>
                                </li>
                              </ul>
                            </div>
                      </div>
                    </div>
                  </div>
                <div class="card-body">
                  <a   wire:click="close" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" class="card-link">Close</a>
                </div>
              </div>
        </div>
        @endif
    </div>
</div>
