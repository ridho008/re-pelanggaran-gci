<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Report;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_id',
        'point',
        'total_point',
    ];

    public function points()
    {
        return $this->belongsTo(Report::class, 'user_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'report_id', 'id');
    }
}
