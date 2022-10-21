<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    public function room()
    {
        return $this->belongsTo('App\Room', 'room_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
