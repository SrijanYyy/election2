<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
    ];
    public function elections()
    {
        return $this->belongsToMany(Election::class, 'election_parties');
    }

    public function electionParties()
    {
        return $this->belongsToMany(ElectionParties::class);
    }
}
