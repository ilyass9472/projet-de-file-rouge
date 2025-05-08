<?php

namespace App\Policies;

use App\Models\Signalement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SignalementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Signalement $signalement)
    {
        if ($user->role_id == 1 || $user->role === 'administrateur') {
            return true;
        }
        
        return $user->id === $signalement->user_id;
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Signalement $signalement)
    {
        if ($user->role_id == 1 || $user->role === 'administrateur') {
            return true;
        }
        
        if ($user->role_id == 4 || $user->role === 'police') {
            return true;
        }
        
        return $user->id === $signalement->user_id;
    }

    public function delete(User $user, Signalement $signalement)
    {
        if ($user->role_id == 1 || $user->role === 'administrateur') {
            return true;
        }
        
        if ($user->role_id == 4 || $user->role === 'police') {
            return true;
        }
        
        return $user->id === $signalement->user_id;
    }

    public function restore(User $user, Signalement $signalement)
    {
        //
    }

    public function forceDelete(User $user, Signalement $signalement)
    {
        //
    }

    public function changeStatus(User $user, Signalement $signalement)
    {
        if ($user->role_id == 1 || $user->role === 'administrateur') {
            return true;
        }
        
        if ($user->role_id == 4 || $user->role === 'police') {
            return true;
        }
        
        if (($user->role_id == 3 || $user->role === 'avocat') && 
            $signalement->dossier && 
            $signalement->dossier->avocat_id === $user->id) {
            return true;
        }
        
        return false;
    }
}
