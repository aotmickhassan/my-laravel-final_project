<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bill;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Bill::create([
            'exam_id' => 1, // Assuming exam_id 1 exists in exams table
            'bank_account' => '123456789',
            'branch_name' => 'Main Branch',
            'routing_number' => '001234567',
            'bill_date' => '2024-03-01',
        ]);

        Bill::create([
            'exam_id' => 2, // Assuming exam_id 2 exists in exams table
            'bank_account' => '987654321',
            'branch_name' => 'Secondary Branch',
            'routing_number' => '007654321',
            'bill_date' => '2024-06-01',
        ]);
        Bill::insert([
            [
                'exam_id' => 1, // Assuming exam_id 1 exists in exams table
                'bank_account' => '10000',
                'branch_name' => 'master Branch',
                'routing_number' => '00222267',
                'bill_date' => '2024-08-01',
            ],
            [
                'exam_id' => 2, // Assuming exam_id 2 exists in exams table
                'bank_account' => '200001',
                'branch_name' => '2nd Branch',
                'routing_number' => '005671',
                'bill_date' => '2024-06-01',
            ],
        ]);
    }
}
