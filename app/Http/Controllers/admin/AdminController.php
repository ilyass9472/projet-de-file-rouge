<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Signalement;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_signalements' => Signalement::count(),
            'pending_signalements' => Signalement::where('status', 'pending')->count()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function signalements()
    {
        $signalements = Signalement::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.signalements.index', compact('signalements'));
    }

    public function signalementsShow($id)
    {
        $signalement = Signalement::findOrFail($id);
        return view('admin.signalements.show', compact('signalement'));
    }
}
?>