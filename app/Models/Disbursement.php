<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongTo;

class Disbursement extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'disbursements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
        'request_id',
        'account_name',
        'released_to',
        'particulars',
        'unit_price'
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(DisbursementRequest::class);
    }


}
