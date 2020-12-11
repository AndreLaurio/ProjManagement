<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function create(Request $request){
        $room = new Room();
        $room->examiner_id = $request->input('examiner_id');
        $room->room_title = $request->input('room_title');
        $room->desc = $request->input('room_description');

        $room->save();
    }
}
