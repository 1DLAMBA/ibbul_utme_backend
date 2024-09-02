<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'dept_sn',
        'reg_number',
        'cand_name',
        'state_of_origin',
        'lga',
        'sex',
        'age',
        'aggregate',
        'fac_abrev',
        'cors_abrev',
        'cors_id',
        'phone_no',
        'no_results',
        'pay_status',
        'gendate',
    ];

    public function olevels()
    {
        return $this->hasMany(Olevel::class, 'reg_number', 'reg_number');
    }
}
