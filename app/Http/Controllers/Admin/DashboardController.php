<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return redirect()->route('dashboard.coming-soon');
        return view('dashboard.admin.overview');
    }
}
