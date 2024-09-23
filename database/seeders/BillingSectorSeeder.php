<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BillingSector;

class BillingSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BillingSector::create([
            'billing_sector_name' => 'Insurance Services',
        ]);
        BillingSector::insert([
            ['billing_sector_name' => 'Electricity'],
            ['billing_sector_name' => 'Water Supply'],
            ['billing_sector_name' => 'Internet Services'],
            ['billing_sector_name' => 'Phone Services'],
            ['billing_sector_name' => 'Gas Supply'],
        ]);
    }
}
