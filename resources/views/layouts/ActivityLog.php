<?php
namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Activity;

class ActivityLog extends Component
{
    public function render()
    {
        $activities = Activity::with('causer')
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.admin.activity-log', [
            'activities' => $activities
        ]);
    }
}
?>