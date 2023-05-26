<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleTotal extends Model
{
    protected $fillable = [
        'date',
        'tithe',
        'offering',
        'mission',
        'sanctuary',
        'love_gift',
        'dance_ministry',
        'grand_total',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}
