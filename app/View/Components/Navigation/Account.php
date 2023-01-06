<?php

namespace App\View\Components\Navigation;

use App\Models\User\User;
use Illuminate\View\View;
use Illuminate\View\Component;

class Account extends Component
{
    /** @var User */
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('components.navigation.account');
    }
}
