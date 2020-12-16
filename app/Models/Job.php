<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Job_Id',
        'Job_Title',
        'Email',
        'Skills_Required',
        'Min_Age',
        'Max_Age',
        'cbacklogs',
        'hbacklogs',
        'qualification',
        'course',
        'cgpa',
        'last_date',
    ];
}
