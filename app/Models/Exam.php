<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exams';

    // Specify the primary key column if it's not 'id'
    protected $primaryKey = 'exam_id';
    protected $fillable = [
        'exam_name',
        'exam_department',
        'session_year',
        'semester',
        'exam_start_date',
        'exam_end_date'
    ];
}
