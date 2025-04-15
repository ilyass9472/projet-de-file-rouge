<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_reports' => Report::count(),
            'recent_activities' => Activity::latest()->take(5)->get(),
            'pending_reports' => Report::where('status', 'pending')->count()
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
?>