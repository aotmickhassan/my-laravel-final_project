<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $table = 'bill_details';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'billing_sector_id',
        'bill_id',
        'course_code',
        'count',
        'is_full_paper',
        'rate',            // Rate per unit
    ];
    public function billingSector()
    {
        return $this->belongsTo(BillingSector::class, 'billing_sector_id');
    }
}