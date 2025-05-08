<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signalement extends Model
{
    use HasFactory;

    protected $table = 'signalement';

    protected $fillable = [
        'user_id',
        'point_id',
        'type',
        'description',
        'statut',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le point
    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}