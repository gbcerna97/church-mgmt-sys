<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Church extends Model
{
    protected $fillable = [
        'church_name',
        'address'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function scheduletotal()
    {
        return $this->hasMany(ScheduleTotal::class);
    }

    public function giver(): HasMany
    {
        return $this->hasMany(Giver::class);
    }
}
