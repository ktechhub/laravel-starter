<?php

namespace App\Http\Livewire\SuperAdmin;

use App\Models\Permission;
use Livewire\Component;

class Permissions extends Component
{
    public $showForm = false;
    public $viewPermission = false;

    public $editItem = false;

    public $permissionId;
    public $permission;

    public $searchTerm;
    public $messageText = '';
    public $alert = '';
    public $previewPermission;
    public $previewPermissionId;

    protected $rules = [
        'permission.name' => 'required|string|max:100|min:2',
        'permission.display_name' => 'required|string|max:100|min:2',
        'permission.description' => 'nullable|string|max:191|min:2',
    ];

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm. '%';
        $permissions = Permission::where('display_name', 'LIKE', $searchTerm)
                                ->where('name', 'LIKE', $searchTerm)
                                ->where('description', 'LIKE', $searchTerm)
                                ->orderBy('created_at', 'desc')
                                ->paginate(14);
        return view('livewire.super-admin.permissions', compact('permissions'));
    }

    public function updated($key, $value)
    {
        $this->validateOnly($key);
    }

    public function create()
    {
        $this->showForm = true;
        $this->viewPermission = false;

        $this->editItem = false;

        $this->permission = null;
        $this->permissionId = null;
    }

    public function save()
    {
        $this->validate();

        if (!is_null($this->permissionId)) {
            $this->permission->save();
            $this->messageText = 'Permission '. $this->permission->display_name . ' is updated';
            $this->alert = 'success';
        } else {
            Permission::create($this->permission);
            $this->messageText = 'New Permission Added';
            $this->alert = 'success';
        }
        $this->showForm = false;
        $this->viewPermission = false;
        $this->editItem = false;
    }

    public function edit($permissionId)
    {
        $this->showForm = true;
        $this->viewPermission = false;

        $this->permissionId = $permissionId;
        $this->permission = Permission::find($permissionId);

        $this->editItem = true;
    }

    public function close()
    {
        $this->permission = null;
        $this->permissionId = null;

        $this->viewPermission = false;
        $this->showForm = false;
    }

    public function closeAlert()
    {
        $this->messageText = '';
        $this->alert = '';
    }

    public function showPreview($permissionId)
    {
        $this->showForm = false;
        $this->viewPermission = true;
        $this->previewPermission = Permission::find($permissionId);
        $this->previewPermissionId = $permissionId;
    }
}
