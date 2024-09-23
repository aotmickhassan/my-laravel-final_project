<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id',
        'bank_account',
        'branch_name',
        'routing_number',
        'bill_date',
    ];
}
