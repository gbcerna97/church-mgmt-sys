<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
        'id',
        'title',
        'date',
        'venue',
        'description',
    ];

    /**
     * Get all of the attendance for the event.
     */
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

}