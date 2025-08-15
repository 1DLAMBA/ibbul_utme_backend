<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlevelRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_name',
        'candidate_name',
        'reg_number',
        'Al1_file',
        'year_of_issue',
        'course',
        'class_of_graduation',
        'result_type',
        'subject1',
        'subject1_grade',
        'subject2',
        'subject2_grade',
        'subject3',
        'subject3_grade',
        'subject4',
        'subject4_grade',
        'mj0',
        'mj0_grade',
        'mj1',
        'mj1_grade',
        'mj2',
        'mj2_grade',
    ];

    public function student()
    {
        return $this->belongsTo(utme_result::class, 'reg_number', 'reg_number');
    }
}
