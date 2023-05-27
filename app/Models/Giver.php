<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Giver extends Model
{
    use HasFactory;

    protected $fillable = [
        'giver_name',
        'date',
        'church_id',
        'tithe',
        'offering',
        'mission',
        'sanctuary',
        'love_gift',
        'dance_ministry',
    ];

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}
