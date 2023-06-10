<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountingService extends Model
{
    protected $fillable = ['type_service', 'date', 'time'];
}
