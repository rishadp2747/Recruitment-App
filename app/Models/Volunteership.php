<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteership extends Model

{
    protected $table = 'volunteerships';

    protected $fillable = [
        'id',
        'volunteerships'
    ];


    use HasFactory;
}
