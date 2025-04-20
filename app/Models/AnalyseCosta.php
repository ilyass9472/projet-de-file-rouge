<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyseCosta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'signalement_id',
        'cout_estime',
        'rapport_dommages',
        'date_evaluation',
        'agent_responsable',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'cout_estime' => 'float',
        'date_evaluation' => 'datetime',
    ];

    /**
     * Get the signalement that owns the analyse.
     */
    public function signalement()
    {
        return $this->belongsTo(Signalement::class);
    }

    /**
     * Generate a report based on the analysis.
     */
    public function genererRapport()
    {
        // Implementation of report generation logic
        $signalement = $this->signalement;
        
        return [
            'id' => $this->id,
            'signalement_id' => $this->signalement_id,
            'cout_estime' => $this->cout_estime,
            'rapport_dommages' => $this->rapport_dommages,
            'date_evaluation' => $this->date_evaluation->format('Y-m-d H:i:s'),
            'agent_responsable' => $this->agent_responsable,
            'signalement_type' => $signalement->type,
            'signalement_date' => $signalement->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Calculate the cost based on damage assessment.
     */
    public function calculerCout()
    {
        // Simplified cost calculation logic - would be more complex in production
        $signalement = $this->signalement;
        $baseCost = 0;
        
        switch ($signalement->type) {
            case 'accident_leger':
                $baseCost = 1000;
                break;
            case 'accident_grave':
                $baseCost = 5000;
                break;
            case 'infrastructure_endommagee':
                $baseCost = 3000;
                break;
            default:
                $baseCost = 500;
        }
        
        // Apply multipliers based on various factors
        $this->cout_estime = $baseCost;
        $this->save();
        
        return $this->cout_estime;
    }
}