<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraitementJuridique extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'dossier_id',
        'avocat_id',
        'statut_juridique',
        'date_prise_en_charge',
        'documents_produits',
        'honoraires_estimes',
        'heures_travaillees',
    ];

    
    protected $casts = [
        'date_prise_en_charge' => 'datetime',
        'documents_produits' => 'array',
        'honoraires_estimes' => 'float',
        'heures_travaillees' => 'float',
    ];

    
    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    
    public function avocat()
    {
        return $this->belongsTo(Avocat::class, 'avocat_id');
    }

    
    public function ajouterDocument($titre, $contenu, $type)
    {
        $document = [
            'titre' => $titre,
            'contenu' => $contenu,
            'type' => $type,
            'date_creation' => now()->format('Y-m-d H:i:s'),
        ];
        
        $documents = $this->documents_produits ?? [];
        $documents[] = $document;
        $this->documents_produits = $documents;
        
        return $this->save();
    }

    
    public function mettreAJourStatutJuridique($statut)
    {
        $this->statut_juridique = $statut;
        return $this->save();
    }

        public function enregistrerConsultation($description, $duree)
    {
        $this->heures_travaillees = ($this->heures_travaillees ?? 0) + $duree;
        
        $consultation = [
            'description' => $description,
            'duree' => $duree,
            'date' => now()->format('Y-m-d H:i:s'),
        ];
        return $this->save();
    }
}