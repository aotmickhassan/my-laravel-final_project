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
    // ALTER TABLE billing_sectors AUTO_INCREMENT = 1;
    public function run(): void
    {
        $sectors = [
            ['billing_sector_name' => 'Paritoshik'],
            ['billing_sector_name' => 'Question Moderation'],
            ['billing_sector_name' => 'Question Composition'],
            ['billing_sector_name' => 'Question Preparation'],
            ['billing_sector_name' => 'Answer Sheet Examining'],
            ['billing_sector_name' => 'Third Examination'],
            ['billing_sector_name' => 'Class Test'],
            ['billing_sector_name' => 'Lab Work'],
            ['billing_sector_name' => 'Central Viva'],
            ['billing_sector_name' => 'Supervision Thesis Undergraduate'],
            ['billing_sector_name' => 'Supervision Thesis Post-graduate'],
            ['billing_sector_name' => 'Supervision Thesis PhD'],
            ['billing_sector_name' => 'Evaluation of Thesis'],
            ['billing_sector_name' => 'Presentation'],
            ['billing_sector_name' => 'Main Invisilation'],
            ['billing_sector_name' => 'Scrutiny'],
            ['billing_sector_name' => 'Presentation'],
            ['billing_sector_name' => 'Tabulation'],
            ['billing_sector_name' => 'Sommani'],
            ['billing_sector_name' => 'Dakmasul'],
        ];

        BillingSector::insert($sectors);
    }
}
