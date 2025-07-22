<?php

namespace App\Livewire\Admin;

use App\Models\FlutterPayment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ClientOrders extends Component
{

    public $selectedOrder = null;
    public $showModal = false;

    #[Layout('layouts.admin_layout')]
    public function render()
    {
        // Get orders with user information including address fields
        $orders = FlutterPayment::leftJoin('users', 'flutter_payments.email', '=', 'users.email')
            ->select(
                'flutter_payments.*',
                'users.country',
                'users.city',
                'users.province',
                'users.address',
                'users.street',
                'users.postal_code'
            )->orderBy('flutter_payments.created_at', 'desc')
            ->get();

        return view('livewire.admin.client-orders',[
            'orders' => $orders,
            'selectedOrder' => $this->selectedOrder,
            'showModal' => $this->showModal,
        ]);
    }

    public function viewOrder($id)
    {
        $this->selectedOrder = FlutterPayment::leftJoin('users', 'flutter_payments.email', '=', 'users.email')
            ->select(
                'flutter_payments.*',
                'users.country',
                'users.city',
                'users.province',
                'users.address',
                'users.street',
                'users.postal_code'
            )
            ->where('flutter_payments.id', $id)
            ->first();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }
}
