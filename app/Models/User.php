<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
        'est_actif',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'est_actif' => 'boolean',
    ];

    /**
     * Get the signalements associated with the user.
     */
    public function signalements()
    {
        return $this->hasMany(Signalement::class, 'utilisateur_id');
    }

    /**
     * Authenticate the user.
     */
    // public function authentifier($password)
    // {
    //     return Hash::check($password, $this->password);
    // }

    /**
     * Update the user profile.
     */
    public function modifierProfil($data)
    {
        return $this->update($data);
    }
}