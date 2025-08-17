<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class utme_result extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_number',
        'dept_sn',
        'cand_name',
        'state_of_origin',
        'reference',
        'transaction_id',
        'payment_date',
        'lga',
        'sex',
        'age',
        'eng_score',
        'subj2',
        'subj2_score',
        'subj3',
        'subj3_score',
        'subj4',
        'subj4_score',
        'total_score',
        'most_preferred_inst',
        'fac_abrev',
        'cors_abrev',
        'cors_id',
        'phone_no',
        'no_results',
        'pay_status',
        'gen_date',
        'ol1_result_file',
        'ol2_result_file',
        'ol1_card_file',
        'ol2_card_file',
        'ol1_card_pin',
        'ol2_card_pin',
        'ol1_serial_number',
        'ol2_serial_number',
        'indigene_file',
        'school_cert_file',
        'nin_file'

    ];

    public function olevels()
    {
        return $this->hasOne(Olevel::class, 'reg_number', 'reg_number');
    }
    public function alevelrecords()
    {
        return $this->hasOne(AlevelRecord::class, 'reg_number', 'reg_number');
    }
}
