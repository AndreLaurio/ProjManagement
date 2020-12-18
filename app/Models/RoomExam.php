<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomExam extends Model
{
    use HasFactory;
    protected $table = 'room_exams';
    protected $primaryKey = 'room_id';
}
