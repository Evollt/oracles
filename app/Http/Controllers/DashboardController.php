<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Crypto\Nft;
use Illuminate\Http\Request;
use App\Models\Crypto\Contract;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('pages.dashboard.index');
    }
}
