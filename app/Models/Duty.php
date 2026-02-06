<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Duty extends Model
{
    protected $fillable = [
        'date',
        'shift',
        'type',
        'owner_id',
        'person_name',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function turnoutLogs(): HasMany
    {
        return $this->hasMany(TurnoutLog::class);
    }
}