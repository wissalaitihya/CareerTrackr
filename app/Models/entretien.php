<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class entretien extends Model
{
    protected $fillable =[
    'candidature_id',
    'type',
    'schedules_at',
    'preparation_notes',
    'result',
    'created_at',
    'updated_at',
    ];
   
    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    
    }
}
