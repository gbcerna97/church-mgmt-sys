<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'inventName',
        'ministryName',
        'category',
        'date_purchased',
        'item_num',
        'unit_cost',
        'total_cost',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(InvetoryImage::class, 'inventory_id');
    }
}