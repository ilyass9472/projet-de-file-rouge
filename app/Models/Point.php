<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'signalement_id',
        'latitude',
        'longitude',
    ];

    /**
     * Get the signalement that owns the point.
     */
    public function signalement()
    {
        return $this->belongsTo(Signalement::class);
    }

    /**
     * Generate an address from the coordinates.
     */
    public function genererAdresse()
    {
        // Implementation with a geocoding service like Google Maps
        // This is a placeholder - you would implement an actual API call here
        $apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$this->latitude},{$this->longitude}&key=YOUR_API_KEY";
        
        // Make API request and parse response
        // For demonstration purposes only:
        $response = ['formatted_address' => '123 Example Street, City, Country'];
        
        return $response['formatted_address'];
    }
}