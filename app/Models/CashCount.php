<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashCount extends Model
{

    protected $fillable = [
        'date',
        'cc_1000',
        'cc_500',
        'cc_200',
        'cc_100',
        'cc_50',
        'cc_20',
        'cc_10',
        'cc_5',
        'cc_1',
        'cc_0_25',
        'cc_0_1',
        'cc_0_05',
        'cc_0_01',
        'total',
    ];

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}
