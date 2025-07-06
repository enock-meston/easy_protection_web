<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Customer extends Component
{
    public string $search = '';
    #[Layout('layouts.admin_layout')]
    public function render()
    {
        if($this->search){
            $customers = User::where('role', 'client')
            ->where('status', 'active')
            ->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->orderBy('name')
            ->get();

        return view('livewire.customer', [
            'customers' => $customers,
        ]);
        }
        $customers = User::where('role', 'client')
            ->where('status', 'active')
            ->orderBy('created_at')
            ->get();
        return view('livewire.customer', [
            'customers' => $customers,
        ]);

    }
}
