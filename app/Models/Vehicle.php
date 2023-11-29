<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        "license_plate",
        "brand",
        "type",
        "year",
        "image_file_name"
    ];

   public function crashEvents() {
        return $this->belongsToMany(CrashEvent::class, 'vehicle_crash_events_connector');
   }
}
