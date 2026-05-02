<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 public function dashboard()
{
    return view('admin.dashboard', [
        'totalProjects'   => Project::count(),
        'activeProjects'  => Project::where('status', 'active')->count(),
        'recentProjects'  => Project::latest()->take(4)->get(),
        'visitorCount'    => '1.2k',
        'messageCount'    => Message::count(),
    ]);
}

}
