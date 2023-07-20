<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TvShow extends Model
{

    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'name',
        'created_year',
        'poster_path',
        'slug',
    ];

    protected function setNameAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }

}
