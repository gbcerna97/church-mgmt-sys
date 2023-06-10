<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'date',
        'fund_source',
        'released_to',
        'particulars',
        'unit_price'
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(DisbursementRequest::class);
    }

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class, 'voucher_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(DisbursementImage::class, 'disbursement_id');
    }

}
