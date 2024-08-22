<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informationbackup extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref_no',
        'zonename',
        'businame',
        'ownername',
        'mob',
        'busiadd',
    ];
}
