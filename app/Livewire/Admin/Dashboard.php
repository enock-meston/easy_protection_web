<?php

namespace App\Livewire\Admin;

use App\Models\FlutterPayment;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.admin_layout')]
    public function render()
    {
        // totalrevenue
        $totalRevenue = FlutterPayment::where('status', 'successful')->sum('amount');
        //total orders
        $totalOrders = FlutterPayment::count();
        // total customers
        $totalCustomers = User::where('role', 'client')->count();
        //total messages
        $totalMessages = Message::count();

        // Fetch the latest 3 orders with user info
        $recentOrders = FlutterPayment::leftJoin('users', 'flutter_payments.email', '=', 'users.email')
            ->select(
                'flutter_payments.*',
                'users.name',
                'users.email as user_email',
                'users.phone',
                'users.country',
                'users.city',
                'users.province',
                'users.address',
                'users.street',
                'users.postal_code'
            )
            ->orderBy('flutter_payments.created_at', 'desc')
            ->limit(3)
            ->get();

        return view('livewire.admin.dashboard',[
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'totalMessages' => $totalMessages,
            'recentOrders' => $recentOrders,
        ]);
    }


     public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }
}
