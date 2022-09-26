<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Point;

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
        'reply_comment',
        'reporting',
        'title'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function report()
    {
        return $this->belongsTo(User::class, 'reporting', 'id');
    }

    public function reportings()
    {
        return $this->belongsTo(User::class, 'reporting', 'id');
    }

    // Points

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    // public function points()
    // {
    //     return $this->belongsTo(Point::class, 'report_id', 'id');
    // }


}
