<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giver extends Model
{
    protected $fillable = [
        'giver_name',
        'tithe',
        'offering',
        'mission',
        'sanctuary',
        'love_gift',
        'dance_ministry',
        'total',
    ];

    public function givers()
    {
        return $this->hasMany(Giver::class, 'date', 'date');
    }
}
