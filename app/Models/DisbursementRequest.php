<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisbursementRequest extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'disbursement_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
        'request_date',
        'prepared_by',
        'verified_by',
        'released_by',
        'approved_by',
        'approved_date',
    ];

    public function disbursements(): HasMany
    {
        return $this->hasMany(Disbursement::class);
    }
}
