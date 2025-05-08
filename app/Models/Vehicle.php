<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'accident_id',
        'type',
        'approximate_speed',
        'direction',
        'position_latitude',
        'position_longitude',
        'driver_condition',
        'additional_details'
    ];
    
    protected $casts = [
        'additional_details' => 'json',
    ];
    
    public function accident()
    {
        return $this->belongsTo(Accident::class);
    }
}
