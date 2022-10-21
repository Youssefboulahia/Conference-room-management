<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Room;
use App\Reservation;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roomBooking()
    {
        $view = View::make('roomBooking');
        return $view;
    }

    public function start()
    {

        $rooms = Room::all();
        $view = View::make('home');
        $view->rooms=$rooms;
        return $view;
    }

    public function roomStore(Request $request)
    {
        $allRooms = Room::all();
        foreach($allRooms as $ro)
        {
            if($ro->title === $request->title)
            {
                return redirect()->back()->with('flash_message','Title must be unique');
            }
        }

        $room = new Room;
       
        $room->title = $request->input('title');
        $room->capacity = $request->input('capacity');
        $room->secretary_id = auth()->user()->id;

        $room->save();
       
        return redirect()->route('home');
    }

    public function roomDelete(Request $request)
    {
        $room = Room::find($request->roomId);

        $reservations = Reservation::where('room_id',$request->roomId)->get();
        foreach($reservations as $res){
            $res->delete();
        }

        $room->delete();
       
        return redirect()->route('home');
    }

    public function roomUpdate(Request $request)
    {

        $allRooms = Room::all();
        foreach($allRooms as $ro)
        {
            if($ro->title === $request->title)
            {
                return redirect()->back()->with('flash_message','Title must be unique');
            }
        }

        $room = Room::find($request->roomId);
       
        $room->title = $request->input('title');
        $room->capacity = $request->input('capacity');

        $room->update();
       
        return redirect()->route('home');
    }



    public function reservation()
    {
        $rooms = Room::all();
        $reservations = Reservation::orderBy('id', 'desc')->paginate(7);
        $skipped = ($reservations->currentPage() * $reservations->perPage()) - $reservations->perPage();

        foreach($reservations as $reservation)
        {
            $reservation->day = Carbon::parse($reservation->day)->format('d-m-yy');
        }
        $view = View::make('dashboard.reservation');
        $view->reservations = $reservations;
        $view->reservationFilter = 'false';
        $view->rooms = $rooms;
        $view->skipped = $skipped;
        return $view;
    }


    public function reservationStore(Request $request)
    {
        if(strtotime($request->start) > strtotime($request->end))
        {
            return redirect()->back()->with('flash_message','Veriffy the starting and the ending of the reservation');
        }

        $allResations = Reservation::where('day','=',$request->day)->where('room_id',Room::where('title',$request->room)->first()->id)->get();

        $from = strtotime($request->start);
        $to = strtotime($request->end);

        if($allResations->count()>0)
        {
            foreach($allResations as $reser)
            {
                $from_compare = strtotime($reser->start); 
                $to_compare = strtotime($reser->end);
        
                if(($from >= $from_compare && $from <= $to_compare) || ($from_compare >= $from && $from_compare <= $to)) 
                {
                    return redirect()->back()->with('flash_message','The room is already reserved at this time!');
                }
            }

        $reservation = new Reservation;
       
        $reservation->description = $request->input('description');
        $reservation->day = $request->input('day');
        $reservation->start = $this->convert_hour($request->input('start'));
        $reservation->end = $this->convert_hour($request->input('end'));
        $reservation->room_id = Room::where('title',$request->room)->first()->id;
        $reservation->user_id = auth()->user()->id;

        $reservation->save();
       
        return redirect()->to('reservation');
        }
        else{
        $reservation = new Reservation;
       
        $reservation->description = $request->input('description');
        $reservation->day = $request->input('day');
        $reservation->start = $this->convert_hour($request->input('start'));
        $reservation->end = $this->convert_hour($request->input('end'));
        $reservation->room_id = Room::where('title',$request->room)->first()->id;
        $reservation->user_id = auth()->user()->id;

        $reservation->save();
       
        return redirect()->to('reservation');
        }
    }

    public function reservationDelete(Request $request)
    {
        $reservation = Reservation::find($request->reservationId);

        $reservation->delete();
       
        return redirect()->to('reservation');
    }

    public function reservationFilter(Request $request)
    {
        $roomId = Room::where('title',$request->filterRoom)->first()->id;
        $rooms = Room::all();
        $reservations = Reservation::orderBy('id', 'desc')->where('room_id',$roomId)->get();
        foreach($reservations as $reservation)
        {
            $reservation->day = Carbon::parse($reservation->day)->format('d-m-yy');
        }
        $view = View::make('dashboard.reservation');
        $view->reservations = $reservations;
        $view->rooms = $rooms;
        $view->reservationFilter = 'true';
        return $view;
    }




    public function calandar()
    {
        $rooms = Room::all();
        $view = View::make('dashboard.calandar');
        $view->rooms = $rooms;
        return $view;
    }

    public function calandarRoom($id)
    {
        $view = View::make('dashboard.calandarview');
        $view->roomId = $id;
        return $view;
    }


    private function convert_hour($hour)
    {
        switch ($hour) {
            case '1:00':
                return'01:00';
                break;
            case '2:00':
                return'02:00';
                break;
            case '3:00':
                return'03:00';
                break;
            case '4:00':
                return'04:00';
                break;
            case '5:00':
                return'05:00';
                break;
            case '6:00':
                return'06:00';
                break;
            case '7:00':
                return'07:00';
                break;
            case '8:00':
                return'08:00';
                break;
            case '9:00':
                return'09:00';
                break;
            default:
               return $hour;
        }
    }



    public function gererUser(){
        $view = View::make('users.show');

        $users = User::where('role','user')->get();
        $view->users = $users;

        return $view;
    }

    public function gererUserAdd(){
        $view = View::make('users.add');

        return $view;
    }

    public function gererUserStore(Request $request){
        $user = new User;
        $checkMail = User::where('email',$request->input('mail'));

        $user->name = $request->input('name');

        if($checkMail->count()>0)
        {
            session()->flash('warning_mail', 'Adresse email existe');
            return redirect()->back();
        }
        else if($checkMail->count()==0)
        {
            $user->email = $request->input('mail');
        }

        if($request->input('password')!==$request->input('confPassword'))
        {
            session()->flash('warning', 'Confirmer le mot de passe');
            return redirect()->back();
        }
        else
        {
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->role = 'user';

        $user->save();

        return redirect()->to('manage_users');
    }

    public function gererUserDelete(Request $request){
        $user = User::where('id',$request->input('userId'));

        $reservations = Reservation::where('user_id', $request->input('userId'))->get();
        foreach($reservations as $res){
            $res->delete();
        }
        
        $user->delete();

        return redirect()->back();
    }

   
}
