<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageUser extends Component
{
    public $search = '';
    public $users = [];

    public $name, $email, $phone, $status = 'active', $role = 'user', $password;
    public $userIdBeingUpdated = null;
    public $showModal = false;

    #[Layout('layouts.admin_layout')]
    public function render()
    {
        $this->users = User::whereIn('role', ['admin', 'user'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.manage-user');
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->userIdBeingUpdated = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->status = $user->status;
        $this->role = $user->role;
        $this->showModal = true;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $this->userIdBeingUpdated,
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:active,inactive',
            'role' => 'required|in:admin,user',
            'password' => $this->userIdBeingUpdated ? 'nullable|min:6' : 'required|min:6',
        ]);

        if ($this->userIdBeingUpdated) {
            $user = User::findOrFail($this->userIdBeingUpdated);
            $user->update(array_merge($validated, [
                'password' => $this->password ? Hash::make($this->password) : $user->password,
            ]));
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => $this->status,
                'role' => $this->role,
                'password' => Hash::make($this->password),
            ]);
        }

        $this->resetFields();
        $this->showModal = false;
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
    }

    private function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
        $this->status = 'active';
        $this->role = 'user';
        $this->userIdBeingUpdated = null;
    }
}
