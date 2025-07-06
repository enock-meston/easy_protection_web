<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageProfile extends Component
{
    public $name, $email, $phone;
    public $showModal = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:15',
            // 'password' => 'nullable|min:6',
        ]);

        $user = User::find(Auth::id());
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            // 'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        $this->showModal = false;
        session()->flash('success', 'Profile updated successfully.');
    }

    #[Layout('layouts.admin_layout')]
    public function render()
    {
        return view('livewire.manage-profile');
    }
}
