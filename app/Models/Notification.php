<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'signalement_id',
        'type',
        'contenu',
        'destinataire',
        'date_envoi',
        'est_lue',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_envoi' => 'datetime',
        'est_lue' => 'boolean',
    ];

    /**
     * Get the signalement that generated the notification.
     */
    public function signalement()
    {
        return $this->belongsTo(Signalement::class);
    }

    /**
     * Send the notification.
     */
    public function envoyer()
    {
        // Implementation of notification sending logic
        // This could involve emails, SMS, push notifications, etc.
        $this->date_envoi = now();
        return $this->save();
    }

    /**
     * Mark the notification as read.
     */
    public function marquerCommeLue()
    {
        $this->est_lue = true;
        return $this->save();
    }
}