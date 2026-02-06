<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function horses(): HasMany
    {
        return $this->hasMany(Horse::class);
    }

    public function duties(): HasMany
    {
        return $this->hasMany(Duty::class);
    }
}