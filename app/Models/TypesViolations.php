<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Point;
use App\Models\Report;

class TypesViolations extends Model
{
    use HasFactory;

    protected $table = 'types_violations';

    protected $fillable = [
        'id',
        'name_violation',
        'sum_points',
    ];

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
