<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function create(Request $request){
        $room = new Room();

        $room->examiner_id = $request->input('examiner_id');
        $room->room_code =  $request->input('room_code');
        $room->room_title = $request->input('room_title');
        $room->room_desc = $request->input('room_description');

        $room->save();
    }

    public function get(Request $request, $instructor_id){
        $rooms = Room::where('examiner_id',$instructor_id)->get();
        return response()->json($rooms);
    }
}
