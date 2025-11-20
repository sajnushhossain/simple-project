<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * The advertisements that belong to the position.
     */
    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class);
    }
}
