<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exam;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Exam::create([
            'exam_name' => '  Examination',
            'exam_department' => 'Computer ',
            'session_year' => '2023-2044',
            'semester' => 'Winter ',
            'exam_start_date' => '2025-06-05',
            'exam_end_date' => '2025-08-18',
        ]);
        Exam::insert([
            [
                'exam_name' => 'Semester Examination',
                'exam_department' => 'Computer Engineering',
                'session_year' => '2025-2026',
                'semester' => 'Fall',
                'exam_start_date' => '2025-06-30',
                'exam_end_date' => '2025-08-10',

            ],
            [
                'exam_name' => 'Final Examination',
                'exam_department' => 'Electrical Engineering',
                'session_year' => '2023-2024',
                'semester' => 'Fall',
                'exam_start_date' => '2024-06-01',
                'exam_end_date' => '2024-06-15',
            ],
            [
                'exam_name' => 'Practical Examination',
                'exam_department' => 'Mechanical Engineering',
                'session_year' => '2022-2023',
                'semester' => 'Autumn',
                'exam_start_date' => '2023-11-01',
                'exam_end_date' => '2023-11-10',
            ],
        ]);
    }
}
