<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TurnoutLog extends Model
{
    protected $fillable = [
        'horse_id',
        'duty_id',
        'pasture_id',
        'brought_out_at',
        'brought_in_at',
        'skipped',
        'notes',
    ];

    protected $casts = [
        'brought_out_at' => 'datetime',
        'brought_in_at' => 'datetime',
        'skipped' => 'boolean',
    ];

    public function horse(): BelongsTo
    {
        return $this->belongsTo(Horse::class);
    }

    public function duty(): BelongsTo
    {
        return $this->belongsTo(Duty::class);
    }
}