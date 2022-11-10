<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscriber extends Model
{
    use HasFactory;

    //status
    const PENDING = 1;
    const TO_CONFIRM = 2;
    const ACTIVE = 3;
    const CANCELED = 4;
    const DISABLED = 5;
    const DELETED = 6;

    //payment methods
    const DEBIT = 1;
    const TRANSFER = 2;

    protected $guarded = [];

    protected $dates = [
        'birthdate',
        'start_date',
        'renovation_date'
    ];

    //RELATIONS
    public function user()
    {
        return $this -> belongsTo(User::Class);
    }
}
