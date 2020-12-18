<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    
    public function get(Request $request, $instructor_id){
        $rooms = Room::where('examiner_id',$instructor_id)->get();
        return response()->json($rooms);
    }
}
