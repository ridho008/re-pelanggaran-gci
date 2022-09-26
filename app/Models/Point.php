<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Report;
use App\Models\TypesViolations;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_id',
        'reporting_point',
        'typevio_id',
        'total_point',
    ];

    // pemanggilan di controller
    public function reports()
    {
        return $this->belongsTo(Report::class, 'report_id', 'id');
    }

    // pemanggilan di indexnya
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function reporting()
    {
        return $this->belongsTo(User::class, 'reporting_point', 'id');
    }

    public function types()
    {
        return $this->belongsTo(TypesViolations::class, 'typevio_id', 'id');
    }

    // public function types()
    // {
    //     return $this->belongsTo(Report::class, 'typevio_id', 'id');
    // }
}
