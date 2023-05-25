<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

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
}
