<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsapCourses extends Model
{
    protected $table = 'asap_courses';

    protected $fillable = [
        'id',
        'course_name'
    ];
    use HasFactory;
}
