<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /** @var string[]  */
    protected $fillable = [
        'bond_id',
        'order_date',
        'purchases_count'
    ];

    /** @var string[]  */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function bond(): BelongsTo
    {
        return $this->belongsTo(Bond::class, 'bond_id', 'id');
    }
}
