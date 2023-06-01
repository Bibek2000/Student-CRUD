<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table='educations';
    protected $fillable = ['student_id', 'level', 'college', 'university', 'start_date', 'end_date'];

    function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
