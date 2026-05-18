<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class candidature extends Model
{
    use SoftDeletes;
    protected $fillable =[

    'user_id',
    'campany_name',
    'job_title',
    'offer_url',
    'status',
    'priority',
    'notes',
    'application_date',
    'attachment',
    'deleted_at',
    'created_at',
    'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    
    }
    public function entretiens()
    {
        return $this->hasMany(Entretien::class);
    }
}
