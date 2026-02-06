<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasture extends Model
{
    protected $fillable = [
        'name',
        'type',
        'gender',
        'capacity',
    ];
}
