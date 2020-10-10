<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return redirect()->route('dashboard.coming-soon');
        return view('dashboard.assistant.overview');
    }
}
