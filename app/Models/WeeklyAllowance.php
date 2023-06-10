<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyAllowance extends Model
{
    use HasFactory;

    protected $table = 'weekly_allowance';

    protected $fillable = [
        'allownce_to',
        'name',
        'allowance',
    ];

    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'voucher_id');
    }

}
