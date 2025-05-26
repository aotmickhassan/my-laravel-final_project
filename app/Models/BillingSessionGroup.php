<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingSessionGroup extends Model
{
    use HasFactory;

    // Optional: If your table name is not `billing_session_groups`, define it explicitly
    // protected $table = 'your_table_name';

    /**
     * The attributes that are mass assignable.
     **/
    protected $fillable = [
        'details',
        'created_by',
        'session',
        'dept',
        'exam_dept', 'year', 'semester', 'exam_start_date', 'exam_end_date',
    ];

    /**
     * Define a one-to-many relationship with BillDetail.
     */
    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'billing_session_group', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Optional: Cast attributes to native types.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // public function billDetails()
    // {
    //     return $this->hasMany(BillDetail::class, 'bill_session_group', 'id');
    // }

}
