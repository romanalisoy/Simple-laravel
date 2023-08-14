<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    use HasFactory;

    /** @var string[]  */
    protected $fillable = [
        'issue_date',
        'last_circulation_date',
        'price',
        'payment_frequency',
        'calculation_period',
        'coupon_rate',
    ];

    /** @var string[]  */
    protected $hidden = [
      'id',
      'created_at',
      'updated_at',
    ];
}
