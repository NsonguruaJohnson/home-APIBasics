<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'course_number', 'description', 'course_code', 'course_lecturer'
    ];

    public $increment = false; #No auto increment i.e 1,2,3,4 ...
}
