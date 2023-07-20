<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Episode extends Model
{

    use HasFactory;

    protected $fillable = [
        'season_id',
        'tmdb_id',
        'name',
        'slug',
        'episode_number',
        'overview',
        'is_public',
        'visits',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function trailers(): MorphMany
    {
        return $this->morphMany(TrailerUrl::class, 'trailerable');
    }

}
