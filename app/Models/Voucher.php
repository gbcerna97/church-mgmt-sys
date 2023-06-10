<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
         // Add _token to the fillable fields
        // Add other fields here
        'voucher_number',
        // ...
    ];
    public function weeklyAllowance()
    {
        return $this->belongsTo(WeeklyAllowance::class, 'voucher_id');
    }

    public function disbursement()
    {
        return $this->belongsTo(Disbursement::class, 'voucher_id');
    }

}
