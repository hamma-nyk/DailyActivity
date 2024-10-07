<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activity';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'activity',
        'tanggal',
    ];
}

