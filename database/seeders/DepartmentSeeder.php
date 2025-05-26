<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    // ALTER TABLE  `departments` AUTO_INCREMENT = 1; 
    public function run(): void
    {
        $departments = [
            ['name' => 'Textile Engineering'],
            ['name' => 'Electrical Engineering'],
            ['name' => 'Computer Science and Engineering'],
            ['name' => 'Chemical Engineering'],
            ['name' => 'Biomedical Engineering'],
            ['name' => 'Industrial Engineering'],
        ];

        Department::insert($departments);
    }
}
