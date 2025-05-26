<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // Define the table name (optional, Laravel will automatically assume 'departments')
    protected $table = 'departments';

    // Fillable fields for mass assignment
    protected $fillable = ['name'];

    // You can define any relationships here if needed (for example, a department can have many bill details).
    // public function billDetails()
    // {
    //     return $this->hasMany(BillDetail::class, 'department_id');
    // }
}
