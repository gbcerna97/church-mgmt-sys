<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Member extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'member_name',
        'nickname',
        'sex',
        'age',
        'birthday',
        'contact_number',
        'occupation',
        'address',
        'email_add',
    ];

    /**
     * Get all of the attendance for the member.
     */
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

}
