<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class SMSMessage extends Model
{

    static $COSTS = 0.15;
    static $MAX_LENGTH = 160;

    protected $fillable = [
        'to', 'from', 'message', 'user_id', 'succeed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
