<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Moment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'source', 
        'date_taken', 
        'direction', 
        'description',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
