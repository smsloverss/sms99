<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Order extends Model
{
    static $IN_PROGRESS = 0;
    static $PAYED = 1;
    static $FAILED = 10;

    protected $fillable = [
        'user_id',
        'amount',
        'cb_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
