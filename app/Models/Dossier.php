<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'signalement_id',
        'statut',
        'date_ouverture',
        'date_cloture',
        'historique_mise_a_jour',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_ouverture' => 'datetime',
        'date_cloture' => 'datetime',
        'historique_mise_a_jour' => 'array',
    ];

    /**
     * Get the signalement that owns the dossier.
     */
    public function signalement()
    {
        return $this->belongsTo(Signalement::class);
    }

    /**
     * Get the traitements juridiques for the dossier.
     */
    public function traitementsJuridiques()
    {
        return $this->hasMany(TraitementJuridique::class);
    }

    /**
     * Follow the dossier progress.
     */
    public function suivreDossier()
    {
        // Implementation of dossier tracking
        return [
            'id' => $this->id,
            'signalement_id' => $this->signalement_id,
            'statut' => $this->statut,
            'date_ouverture' => $this->date_ouverture ? $this->date_ouverture->format('Y-m-d') : null,
            'date_cloture' => $this->date_cloture ? $this->date_cloture->format('Y-m-d') : null,
            'historique' => $this->historique_mise_a_jour,
            'traitements_juridiques' => $this->traitementsJuridiques()->count(),
        ];
    }

    /**
     * Update the dossier status.
     */
    public function mettreAJourStatut($statut, $commentaire = null)
    {
        $old_statut = $this->statut;
        $this->statut = $statut;
        
        $miseAJour = [
            'date' => now()->format('Y-m-d H:i:s'),
            'statut_precedent' => $old_statut,
            'nouveau_statut' => $statut,
        ];
        
        if ($commentaire) {
            $miseAJour['commentaire'] = $commentaire;
        }
        
        $historique = $this->historique_mise_a_jour ?? [];
        $historique[] = $miseAJour;
        $this->historique_mise_a_jour = $historique;
        
        if ($statut === 'cloture') {
            $this->date_cloture = now();
        }
        
        return $this->save();
    }
}