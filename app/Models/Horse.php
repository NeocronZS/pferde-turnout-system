<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Horse extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'box_number',
        'owner_id',
        'box_rest',
        'gender',
        'notes',
    ];

    protected $casts = [
        'box_rest' => 'boolean',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function turnoutLogs(): HasMany
    {
        return $this->hasMany(TurnoutLog::class);
    }
}   //

