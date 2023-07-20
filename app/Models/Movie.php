<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Movie extends Model
{

    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'title',
        'runtime',
        'release_date',
        'lang',
        'rating',
        'overview',
        'poster_path',
        'video_format',
        'is_public',
        'backdrop_path',
        'slug',
    ];

    protected function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }

    public function trailers(): MorphMany
    {
        return $this->morphMany(TrailerUrl::class, 'trailerable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function casts(): BelongsToMany
    {
        return $this->belongsToMany(Cast::class, 'cast_movie');
    }

}
