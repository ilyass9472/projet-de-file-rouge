<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationAccident extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'signalement_id',
        'scenario_type',
        'vitesse',
        'angle_impact',
        'date_simulation',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'vitesse' => 'float',
        'angle_impact' => 'float',
        'date_simulation' => 'datetime',
    ];

    /**
     * Get the signalement that owns the simulation.
     */
    public function signalement()
    {
        return $this->belongsTo(Signalement::class);
    }

    /**
     * Generate a risk report based on the simulation.
     */
    public function genererRapportRisque()
    {
        // Implementation of risk report generation logic
        return [
            'id' => $this->id,
            'signalement_id' => $this->signalement_id,
            'scenario_type' => $this->scenario_type,
            'vitesse' => $this->vitesse,
            'angle_impact' => $this->angle_impact,
            'date_simulation' => $this->date_simulation->format('Y-m-d H:i:s'),
            'niveau_risque' => $this->calculerNiveauRisque(),
            'recommandations' => $this->genererRecommandations(),
        ];
    }

    /**
     * Analyze security factors.
     */
    public function analyserFacteursSecurite()
    {
        // Implementation of security factors analysis
        $facteurs = [
            'visibilite' => $this->evaluerVisibilite(),
            'etat_route' => $this->evaluerEtatRoute(),
            'signalisation' => $this->evaluerSignalisation(),
            'meteo' => $this->evaluerConditionsMeteo(),
        ];
        
        return $facteurs;
    }

    /**
     * Calculate risk level.
     */
    private function calculerNiveauRisque()
    {
        // Simplified risk calculation
        $risk = 0;
        
        // Higher speed means higher risk
        if ($this->vitesse > 100) {
            $risk += 3;
        } elseif ($this->vitesse > 50) {
            $risk += 2;
        } else {
            $risk += 1;
        }
        
        // Angle impact risk
        if ($this->angle_impact > 45) {
            $risk += 3;
        } elseif ($this->angle_impact > 20) {
            $risk += 2;
        } else {
            $risk += 1;
        }
        
        // Map numerical risk to categories
        if ($risk >= 5) {
            return 'Élevé';
        } elseif ($risk >= 3) {
            return 'Moyen';
        } else {
            return 'Faible';
        }
    }

    /**
     * Generate recommendations based on the simulation.
     */
    private function genererRecommandations()
    {
        // Simplified recommendation generation
        $recommendations = [];
        $niveauRisque = $this->calculerNiveauRisque();
        
        if ($niveauRisque === 'Élevé') {
            $recommendations[] = 'Installation de barrières de sécurité recommandée';
            $recommendations[] = 'Réduction de la vitesse autorisée';
            $recommendations[] = 'Amélioration de la signalisation';
        } elseif ($niveauRisque === 'Moyen') {
            $recommendations[] = 'Inspection régulière de l\'état de la route';
            $recommendations[] = 'Amélioration de la signalisation horizontale';
        }
        
        return $recommendations;
    }

    // Helper evaluation methods
    private function evaluerVisibilite()
    {
        // Placeholder implementation
        return rand(1, 10);
    }
    
    private function evaluerEtatRoute()
    {
        // Placeholder implementation
        return rand(1, 10);
    }
    
    private function evaluerSignalisation()
    {
        // Placeholder implementation
        return rand(1, 10);
    }
    
    private function evaluerConditionsMeteo()
    {
        // Placeholder implementation
        return rand(1, 10);
    }
}