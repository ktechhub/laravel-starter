<?php

namespace App\Http\Livewire\SuperAdmin;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public $showForm = false;
    public $viewUser = false;

    public $editItem = false;

    public $userId;
    public $user;

    public $name;
    public $username;
    public $email;
    public $password;

    public $permission = [];
    public $detachPermission = [];

    public $attachRole = [];
    public $detachRole = [];

    public $searchTerm;
    public $messageText = '';
    public $alert = '';
    public $previewUser;
    public $previewUserId;

    protected $rules = [
        'name' => ['nullable', 'string', 'max:255'],
        'username' => ['nullable', 'string', 'max:255', 'unique:users'],
        'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required','string', 'min:6'],
        'permission.*' => 'nullable',
        'detachPermission.*' => 'nullable',
    ];

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm. '%';
        $users = User::where('username', 'LIKE', $searchTerm)
                                ->where('name', 'LIKE', $searchTerm)
                                ->where('email', 'LIKE', $searchTerm)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
        $permissions = Permission::all();
        $roles = Role::all();
        return view('livewire.super-admin.users', compact('roles', 'permissions', 'users'));
    }

    public function updated($key, $value)
    {
        $this->validateOnly($key);
    }

    public function create()
    {
        $this->showForm = true;
        $this->viewUser = false;

        $this->editItem = false;

        $this->user = null;
        $this->userId = null;
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
    }

    public function save()
    {

        if (!is_null($this->userId)) {
            $user = User::find($this->userId);
            $user->password = Hash::make($this->password);
            $user->save();
            $this->messageText = 'User '. $this->user->username . ' is updated';
            $this->alert = 'success';
        } else {
            $this->validate();
            if ($this->name == null || $this->username == null || $this->email == null) {
                $this->messageText = 'Fill All Input Fields';
                $this->alert = 'danger';
                return back();
            }
            $this->user = [
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ];
            User::create($this->user);
            $this->messageText = 'New User Added';
            $this->alert = 'success';
        }
        $this->showForm = false;
        $this->viewUser = false;
        $this->editItem = false;
        $this->user = '';
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
    }

    public function edit($userId)
    {
        $this->showForm = true;
        $this->viewUser = false;

        $this->userId = $userId;
        $this->user = User::find($userId);

        $this->password = '';
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;

        $this->editItem = true;
    }

    public function close()
    {
        $this->user = null;
        $this->userId = null;

        $this->viewUser = false;
        $this->showForm = false;
    }

    public function closeAlert()
    {
        $this->messageText = '';
        $this->alert = '';
    }

    public function showPreview($userId)
    {
        $this->showForm = false;
        $this->viewUser = true;
        $this->previewUser = User::find($userId);
        $this->user = User::find($userId);
        $this->userId = $userId;
    }

    public function attachRoles()
    {
        $user = $this->user;

        if ($this->attachRole !== null) {
            $user->attachRoles($this->attachRole);
        }

        $this->messageText = 'Roles assigned to ' .$user->username;
        $this->alert = 'warning';
        $this->attachRole = [];
    }

    public function detachRoles()
    {
        $user = $this->user;

        if ($user->username === 'Kalkulus') {
            $this->messageText = 'You can detach roles on user';
            $this->alert = 'danger';
            return back();
        }

        if ($this->detachRole !== null) {
            $user->detachRoles($this->detachRole);
            foreach ($this->detachRole as $value) {
                $role = Role::find($value);
                $item = $role->permissions;
                $user->detachPermissions($item->pluck('id'));
            }
        }

        $this->messageText = 'Roles detached on ' .$user->username;
        $this->alert = 'warning';
        $this->detachRole = [];
    }

    public function assignAllRoles()
    {
        $user = $this->user;
        $roles = Role::all();
        $user->syncRoles($roles);
        $this->messageText = 'All Roles assigned to ' .$user->username;
        $this->alert = 'warning';
    }

    public function detachAllRoles()
    {
        $user = $this->user;

        if ($user->username === 'Kalkulus') {
            $this->messageText = 'You can detach roles on user';
            $this->alert = 'danger';
            return back();
        }

        $roles = Role::all();
        $user->detachRoles($roles);
        foreach ($roles as $role) {
            $item = $role->permissions;
            $user->detachPermissions($item->pluck('id'));
        }
        $this->messageText = 'All Roles detaced on ' .$user->username;
        $this->alert = 'danger';
    }


    public function assignPermissions()
    {
        $user = $this->user;

        if ($this->permission !== null) {
            $user->attachPermissions($this->permission);
        }

        $this->messageText = 'Permissions assigned to ' .$user->username;
        $this->alert = 'warning';
        $this->permission = [];
    }

    public function detachPermissions()
    {
        $user = $this->user;

        if ($user->username === 'Kalkulus') {
            $this->messageText = 'You can detach permissions on user';
            $this->alert = 'danger';
            return back();
        }

        if ($this->detachPermission !== null) {
            $user->detachPermissions($this->detachPermission);
        }

        $this->messageText = 'Permissions detached on ' .$user->username;
        $this->alert = 'warning';
        $this->detachPermission = [];
    }

    public function assignAll()
    {
        $user = $this->user;
        $perms = Permission::all();
        $user->syncPermissions($perms);
        $this->messageText = 'All Permissions assigned to ' .$user->username;
        $this->alert = 'warning';
    }

    public function detachAll()
    {
        $user = $this->user;
        if ($user->username === 'Kalkulus') {
            $this->messageText = 'You can detach permissions on user';
            $this->alert = 'danger';
            return back();
        }
        $perms = Permission::all();
        $user->detachPermissions($perms);
        $this->messageText = 'All Permissions detached on ' .$user->username;
        $this->alert = 'danger';
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->username === 'Kalkulus') {
            $this->messageText = 'You cannot delete '. $user->username . '!';
            $this->alert = 'danger';
            return back();
        }

        $perms = Permission::all();
        $user->detachPermissions($perms);

        $roles = Role::all();
        $user->detachRoles($roles);

        $user->delete();
        $this->messageText = 'User deleted successfully!';
        $this->alert = 'danger';
    }
}
