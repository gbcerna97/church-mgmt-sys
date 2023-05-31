<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attendance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['event_id', 'member_id', 'present'];

    public $timestamps = false;

    /**
     * Get the member associated with the attendance.
     */
    public function member(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }

    /**
     * Get the events associated with the attendance.
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
