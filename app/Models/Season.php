<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{

    use HasFactory;

    protected $fillable = [
        'serie_id',
        'tmdb_id',
        'name',
        'slug',
        'season_number',
        'poster_path',
    ];

    public function tvShow(): BelongsTo
    {
        return $this->belongsTo(TvShow::class);
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

}
