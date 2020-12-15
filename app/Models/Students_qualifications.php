<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students_qualifications extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'cgpa',
        'board',
        'institution',
        'join',
        'pass',
        'qualification',
        'course',
        'cbacklogs',
        'hbacklogs',
    ];
}
