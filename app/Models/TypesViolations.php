<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesViolations extends Model
{
    use HasFactory;

    protected $table = 'types_violations';

    protected $fillable = [
        'id',
        'name_violation',
        'sum_points',
    ];
}
