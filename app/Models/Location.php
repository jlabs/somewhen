<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Location extends Model
{
    use HasFactory;

    protected $casts = [
        'coordinates' => 'json',
        'date_taken' => 'date:Y-m-d'
    ];
    protected $fillable = [
        'title',
        'coordinates'
    ];

    public function moments() : HasMany
    {
        return $this->hasMany(Moment::class);
    }
}
