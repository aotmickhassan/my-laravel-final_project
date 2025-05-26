<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'emp_name' => 'Ariful Ahmed',
            'emp_designation' => 'Software Engineer',
            'emp_address' => '123 new market, jashore'
        ]);
        Employee::create([
            'emp_name' => 'William Brown',
            'emp_designation' => 'DevOps Engineer',
            'emp_address' => '654 Cedar Lane, Metrocity',
            'created_at' => Carbon::createFromFormat('d/m/Y H:i:s', '10/05/2024 11:00:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::createFromFormat('d/m/Y H:i:s', '10/05/2024 11:00:00')->format('Y-m-d H:i:s'),
        ]);
        Employee::insert([
            [
                'emp_name' => 'John Doe',
                'emp_designation' => 'Software Engineer',
                'emp_address' => '123 Main Street, Cityville',
                'created_at' => '2024-01-01 10:00:00',  // Specific date and time
                'updated_at' => '2024-01-01 10:00:00',  // Specific date and time
            ],
            [
                'emp_name' => 'Jane Smith',
                'emp_designation' => 'Project Manager',
                'emp_address' => '456 Elm Street, Townsville',
                'created_at' => '2024-02-15 12:30:00',  // Specific date and time
                'updated_at' => '2024-02-15 12:30:00',  // Specific date and time
            ],
            [
                'emp_name' => 'Michael Johnson',
                'emp_designation' => 'Database Administrator',
                'emp_address' => '789 Pine Avenue, Villagetown',
                'created_at' => '2024-03-20 09:45:00',  // Specific date and time
                'updated_at' => '2024-03-20 09:45:00',  // Specific date and time
            ],
            [
                'emp_name' => 'Emily Davis',
                'emp_designation' => 'Quality Assurance',
                'emp_address' => '321 Maple Road, Suburbia',
                'created_at' => '2024-04-05 08:15:00',  // Specific date and time
                'updated_at' => '2024-04-05 08:15:00',  // Specific date and time
            ],
            [
                'emp_name' => 'William Brown',
                'emp_designation' => 'DevOps Engineer',
                'emp_address' => '654 Cedar Lane, Metrocity',
                'created_at' => '2024-05-10 11:00:00',  // Specific date and time
                'updated_at' => '2024-05-10 11:00:00',  // Specific date and time
            ]
        ]);
    }
}
