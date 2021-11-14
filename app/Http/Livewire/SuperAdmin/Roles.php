<?php

namespace App\Http\Livewire\SuperAdmin;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class Roles extends Component
{
    public $showForm = false;
    public $viewRole = false;

    public $editItem = false;

    public $roleId;
    public $role;
    public $permission = [];
    public $detachPermission = [];

    public $searchTerm;
    public $messageText = '';
    public $alert = '';
    public $previewRole;
    public $previewRoleId;

    protected $rules = [
        'role.name' => 'required|string|max:100|min:2',
        'role.display_name' => 'required|string|max:100|min:2',
        'role.description' => 'nullable|string|max:191|min:2',
        'permission.*' => 'nullable',
        'detachPermission.*' => 'nullable',
    ];

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm. '%';
        $roles = Role::where('display_name', 'LIKE', $searchTerm)
                                ->where('name', 'LIKE', $searchTerm)
                                ->where('description', 'LIKE', $searchTerm)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
        $permissions = Permission::all();
        return view('livewire.super-admin.roles', compact('roles', 'permissions'));
    }

    public function updated($key, $value)
    {
        $this->validateOnly($key);
    }

    public function create()
    {
        $this->showForm = true;
        $this->viewRole = false;

        $this->editItem = false;

        $this->role = null;
        $this->roleId = null;
    }

    public function save()
    {
        $this->validate();

        if (!is_null($this->roleId)) {
            $this->role->save();
            $this->messageText = 'Role '. $this->role->display_name . ' is updated';
            $this->alert = 'success';
        } else {
            Role::create($this->role);
            $this->messageText = 'New Role Added';
            $this->alert = 'success';
        }
        $this->showForm = false;
        $this->viewRole = false;
        $this->editItem = false;
    }

    public function edit($roleId)
    {
        $this->showForm = true;
        $this->viewRole = false;

        $this->roleId = $roleId;
        $this->role = Role::find($roleId);

        $this->editItem = true;
    }

    public function close()
    {
        $this->role = null;
        $this->roleId = null;

        $this->viewRole = false;
        $this->showForm = false;
    }

    public function closeAlert()
    {
        $this->messageText = '';
        $this->alert = '';
    }

    public function showPreview($roleId)
    {
        $this->showForm = false;
        $this->viewRole = true;
        $this->previewRole = Role::find($roleId);
        $this->role = Role::find($roleId);
        $this->roleId = $roleId;
    }

    public function assignPermissions()
    {
        $role = $this->role;

        if ($this->permission !== null) {
            $role->attachPermissions($this->permission);
        }

        $this->messageText = 'Permissions assigned to ' .$role->display_name;
        $this->alert = 'warning';
        $this->permission = [];
    }

    public function detachPermissions()
    {
        $role = $this->role;

        if ($this->detachPermission !== null) {
            $role->detachPermissions($this->detachPermission);
        }

        $this->messageText = 'Permissions detached on ' .$role->display_name;
        $this->alert = 'warning';
        $this->detachPermission = [];
    }

    public function assignAll()
    {
        $role = $this->role;
        $perms = Permission::all();
        $role->syncPermissions($perms);
        $this->messageText = 'All Permissions assigned to ' .$role->display_name;
        $this->alert = 'warning';
    }

    public function detachAll()
    {
        $role = $this->role;
        $perms = Permission::all();
        $role->detachPermissions($perms);
        $this->messageText = 'All Permissions detached on ' .$role->display_name;
        $this->alert = 'danger';
    }
}
