<?php

namespace App\Notifications;

use App\Models\Dossier;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CaseStatusChanged extends Notification
{
    use Queueable;

    protected $dossier;
    protected $user;

    public function __construct(Dossier $dossier, User $user)
    {
        $this->dossier = $dossier;
        $this->user = $user;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $dossierRef = 'DOSSIER-' . str_pad($this->dossier->id, 5, '0', STR_PAD_LEFT);
        
        return (new MailMessage)
            ->subject("Modification du statut d'un dossier - {$dossierRef}")
            ->line("Le statut du dossier {$dossierRef} a été modifié par {$this->user->name}.")
            ->line("Nouveau statut: {$this->dossier->getStatusLabel()}")
            ->action('Voir le dossier', url("/lawyer/cases/{$this->dossier->signalement_id}"))
            ->line("Cette modification a été effectuée le " . now()->format('d/m/Y à H:i'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'dossier_id' => $this->dossier->id,
            'signalement_id' => $this->dossier->signalement_id,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'status' => $this->dossier->status,
            'status_label' => $this->dossier->getStatusLabel(),
            'timestamp' => now()->toIso8601String()
        ];
    }
}