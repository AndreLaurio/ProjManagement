<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomExam;
use DB;

class ExamController extends Controller
{
    public function getExam(Request $request, $room_id){
        $room_exam = DB::table('room_exams as re')
            ->join('exams as e', 'e.exam_id', 're.exam_id')
            ->where('re.room_id', $room_id)
            ->get();

            return $room_exam;
    }

    public function getExaminerExam(Request $request, $examiner_id){
        $examiner_exam = DB::table('exams')
            ->where('examiner_id', $examiner_id)
            ->get();

            return $examiner_exam;
    }
}
