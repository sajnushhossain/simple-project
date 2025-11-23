<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'image_path',
        'target_url',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The positions that belong to the advertisement.
     */
    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    /**
     * Scope a query to only include active advertisements for a given position.
     */
    public function scopeActiveForPosition(Builder $query, string $positionSlug): Builder
    {
        return $query->where('is_active', true)
            ->whereHas('positions', function (Builder $query) use ($positionSlug) {
                $query->where('slug', $positionSlug);
            });
    }
}
