<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingSector extends Model
{
    use HasFactory;
    protected $fillable = ['billing_sector_name'];
    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'billing_sector_id');
    }
}
