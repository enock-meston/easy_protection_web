<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ClientProfile extends Component
{
    public $name, $email, $phone, $country, $city, $province, $address, $street, $postal_code;
    public $showEditModal = false;
    public $showPasswordModal = false;
    public $current_password, $new_password, $new_password_confirmation;

    public function mount()
    {
        $this->loadUserData();
    }

    public function loadUserData()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->country = $user->country;
        $this->city = $user->city;
        $this->province = $user->province;
        $this->address = $user->address;
        $this->street = $user->street;
        $this->postal_code = $user->postal_code;
    }

    public function openEditModal()
    {
        $this->showEditModal = true;
    }

    public function openPasswordModal()
    {
        $this->showPasswordModal = true;
        $this->resetPasswordFields();
    }

    public function resetPasswordFields()
    {
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
        ]);

        Auth::user()->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'province' => $this->province,
            'address' => $this->address,
            'street' => $this->street,
            'postal_code' => $this->postal_code,
        ]);

        $this->showEditModal = false;
        session()->flash('success', 'Profile updated successfully!');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            session()->flash('error', 'Current password is incorrect.');
            return;
        }

        $user->update([
            'password' => Hash
            ::make($this->new_password)
        ]);

        $this->showPasswordModal = false;
        $this->resetPasswordFields();
        session()->flash('success', 'Password updated successfully!');
    }

    public function closeModal()
    {
        $this->showEditModal = false;
        $this->showPasswordModal = false;
        $this->resetPasswordFields();
    }

    #[Layout('layouts.home_layout')]
    public function render()
    {
        return view('livewire.client-profile');
    }
}
