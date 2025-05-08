<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'accident_id',
        'role',
        'injury_type',
        'age',
        'gender',
        'additional_notes'
    ];
    
    public function accident()
    {
        return $this->belongsTo(Accident::class);
    }
}