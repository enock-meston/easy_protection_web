<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageMessages extends Component
{
    public $selectedMessage = null;

    public function view($id)
    {
        $this->selectedMessage = Message::findOrFail($id);
    }

    public function updateStatus($id, $status)
    {
        $msg = Message::findOrFail($id);
        $msg->status = $status;
        $msg->save();
        // Refresh selectedMessage if it's the one being updated
        if ($this->selectedMessage && $this->selectedMessage->id == $id) {
            $this->selectedMessage = $msg;
        }
    }


    #[Layout('layouts.admin_layout')]
    public function render()
    {
        $messages = Message::all();
        $pendingMessages = Message::where('status', 'pending')->get();
        $readMessages = Message::where('status', 'read')->get();
        $repliedMessages = Message::where('status', 'replied')->get();
        $solvedMessages = Message::where('status', 'solved')->get();
        $totalMessages = Message::count();

        return view('livewire.manage-messages',[
            'messages' => $messages,
            'pendingMessages' => $pendingMessages,
            'readMessages' => $readMessages,
            'repliedMessages' => $repliedMessages,
            'solvedMessages' => $solvedMessages,
            'totalMessages' => $totalMessages,
        ]);
    }
}
