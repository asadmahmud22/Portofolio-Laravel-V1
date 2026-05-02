<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        return view('admin.profile.index');
    }

    public function statistics()
    {
        return view('admin.statistics');
    }

    public function settings()
    {
        return view('admin.settings.index');
    }
}
