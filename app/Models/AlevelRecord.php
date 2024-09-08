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
    ];
}
