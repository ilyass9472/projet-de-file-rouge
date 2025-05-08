<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'accident_id',
        'path',
    ];

    /**
     * Get the accident that owns this photo.
     */
    public function accident()
    {
        return $this->belongsTo(Accident::class);
    }
}