<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signalement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utilisateur_id',
        'type',
        'description',
        'localisation_latitude',
        'localisation_longitude',
        'photos',
        'statut',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'photos' => 'array',
        'date_creation' => 'datetime',
        'date_mise_a_jour' => 'datetime',
    ];

    /**
     * Get the user that created the signalement.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    /**
     * Get the point that represents the signalement's location.
     */
    public function point()
    {
        return $this->hasOne(Point::class);
    }

    /**
     * Get the notifications for the signalement.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the analyse costa for the signalement.
     */
    public function analyseCosta()
    {
        return $this->hasOne(AnalyseCosta::class);
    }

    /**
     * Get the dossier for the signalement.
     */
    public function dossier()
    {
        return $this->hasOne(Dossier::class);
    }

    /**
     * Get the simulation accidents for the signalement.
     */
    public function simulationAccidents()
    {
        return $this->hasMany(SimulationAccident::class);
    }

    /**
     * Create a new signalement.
     */
    public function creerSignalement($data)
    {
        return self::create($data);
    }

    /**
     * Update the signalement.
     */
    public function mettreAJour($data)
    {
        return $this->update($data);
    }

    /**
     * Add a photo to the signalement.
     */
    public function ajouterPhoto($photoPath)
    {
        $photos = $this->photos ?? [];
        $photos[] = $photoPath;
        $this->photos = $photos;
        return $this->save();
    }
}