<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentdetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Photo',
        'Email',
        'Age',
        'DOB',
        'Address',
        'Qualifications',
        'Skills',
        'CV',
        'Phoneno',
    ];
}
