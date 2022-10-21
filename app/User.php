<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Reservation;

class User extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations(){
        return $this ->hasMany('App\Reservation', 'user_id');
    }


      public function isSecretary()
      {
          if(Auth()->user()->role==='secretary')
          {
              return true;
          }
          else
          {
              return false;
          }
      }

      public function myReservation($id){
          $reservation = Reservation::where('id',$id)->first();
          if($reservation->user_id===Auth()->user()->id)
          {
              return true;
          }
          else{
              return false;
          }
      }

    
}
