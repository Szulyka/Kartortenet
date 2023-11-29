<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        "searched_license_plate",
        "search_date"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
