<?php

namespace App\Livewire;

use App\Models\FlutterPayment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MyOrders extends Component
{

    public $selectedOrder = null;
    public $showModal = false;

    #[Layout('layouts.home_layout')]
    public function render()
    {
        // select all orders from flutter_payments table by email
        $orders = FlutterPayment::where('email', Auth::user()->email)->get();

        return view('livewire.my-orders', [
            'orders' => $orders,
            'selectedOrder' => $this->selectedOrder,
            'showModal' => $this->showModal,
        ]);
    }

    public function viewOrder($id)
    {
        $this->selectedOrder = FlutterPayment::find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }
}
