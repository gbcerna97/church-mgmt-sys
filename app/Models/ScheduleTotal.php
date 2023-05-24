<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
