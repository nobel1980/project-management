<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin');
    }

    public function developer()
    {
        return view('dashboard.developer');
    }

    public function user()
    {
        return view('dashboard.user');
    }
}
