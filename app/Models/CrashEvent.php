<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrashEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        "place",
        "date",
        "description"
    ];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'vehicle_crash_events_connector');
    }
}
