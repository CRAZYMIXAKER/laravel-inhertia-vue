<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TrailerUrl extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'embed_html'];

    public function trailerable(): MorphTo
    {
        return $this->morphTo();
    }
}
