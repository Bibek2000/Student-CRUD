<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table ='students';
    protected $fillable = ['education_id','name', 'email', 'phone', 'address', 'image', 'gender', 'dob'];

    function educations(){
        return $this->hasMany(Education::class);
}
}

