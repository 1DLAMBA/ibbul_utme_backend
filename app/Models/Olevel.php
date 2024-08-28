<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'reg_number',
        'olevel1_exam',
        'olevel1_examno',
        'olevel1_examilyear',
        'olevel1_examilyear_t',
        'olevel1_exammonth',
        'olevel1_exammonth_t',
        'ol1_result_pin',
        'ol1_result_sno',
        'ol1_s1',
        'ol1_g1',
        'ol1_s2',
        'ol1_g2',
        'ol1_s3',
        'ol1_g3',
        'ol1_s4',
        'ol1_g4',
        'ol1_s5',
        'ol1_g5',
        'ol1_s6',
        'ol1_g6',
        'ol1_s7',
        'ol1_g7',
        'ol1_s8',
        'ol1_g8',
        'ol1_s9',
        'ol1_g9',
        'ol1_s10',
        'ol1_g10',
        'ol1_s11',
        'ol1_g11',
        'ol1_s12',
        'ol1_g12',
        'olevel2_exam',
        'olevel2_examno',
        'olevel2_examilyear',
        'olevel2_examilyear_t',
        'olevel2_exammonth',
        'olevel2_exammonth_t',
        'ol2_result_pin',
        'ol2_result_sno',
        'ol2_s1',
        'ol2_g1',
        'ol2_s2',
        'ol2_g2',
        'ol2_s3',
        'ol2_g3',
        'ol2_s4',
        'ol2_g4',
        'ol2_s5',
        'ol2_g5',
        'ol2_s6',
        'ol2_g6',
        'ol2_s7',
        'ol2_g7',
        'ol2_s8',
        'ol2_g8',
        'ol2_s9',
        'ol2_g9',
        'ol2_s10',
        'ol2_g10',
        'ol2_s11',
        'ol2_g11',
        'ol2_s12',
        'ol2_g12',
        'last_updated'
    ];

    public function student()
    {
        return $this->belongsTo(utme_result::class, 'reg_number', 'reg_number');
    }

}
