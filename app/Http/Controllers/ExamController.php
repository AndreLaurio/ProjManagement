<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomExam;

class ExamController extends Controller
{
    public function getExam(Request $request, $room_id){
        $room_exam = DB::table('room_exams as re')
            ->join('exams as e', 'e.exam_id', 're.exam_id')
            ->where('re.room_id', $room_id)
            ->get();

            return $room_exam;
    }
}
