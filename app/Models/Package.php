<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'date',
        'room',
        'bed',
        'name',
        'error',
    ];
}
