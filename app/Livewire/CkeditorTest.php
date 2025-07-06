<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CkeditorTest extends Component
{
    public $description = '';

    public function save()
    {
        dd($this->description); // Just test if it's working
    }
    #[Layout('layouts.admin_layout')]
    public function render()
    {
        return view('livewire.ckeditor-test');
    }
}
