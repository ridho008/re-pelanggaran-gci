<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
        'reporting'
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
}
