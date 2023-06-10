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
        'counting_services_id',
        'church_id',
        'tithe',
        'offering',
        'mission',
        'sanctuary',
        'love_gift',
        'dance_ministry',
        'is_cash',
        'is_cheque'
    ];

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}
