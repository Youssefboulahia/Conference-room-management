<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Carbon\Carbon;

class CalandarController extends Controller
{
    public function getData(Request $request)
    {
        $date_now = Carbon::now()->format('yy-m-d');

        $arr = array(
            "data"=>[],
            "date"=> $date_now,
        );
        $id = $request->input('id');
        $reservations = Reservation::where('room_id',$id)->get();

        foreach($reservations as $reservation)
        {
            array_push($arr['data'],array(
                "title" => $reservation->description,
                "start"=> Carbon::parse($reservation->day)->format('yy-m-d').'T'.$reservation->start,
                "end"=>  Carbon::parse($reservation->day)->format('yy-m-d').'T'.$reservation->end,
     
            ));
        }
       
        
      
        return $arr;
    }
}

