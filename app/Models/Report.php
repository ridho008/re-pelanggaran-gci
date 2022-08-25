<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';

    protected $fillable = [
        'id',
        'status',
        'proof_fhoto',
        'reporting_date',
        'user_id',
        'description',
    ];
}
