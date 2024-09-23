<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    // Specify the table name if it doesn't follow the plural naming convention
    protected $table = 'employees';

    // Specify the primary key column if it's not 'id'
    protected $primaryKey = 'emp_id';

    // The attributes that are mass assignable
    protected $fillable = ['emp_name', 'emp_designation', 'emp_address'];
}
