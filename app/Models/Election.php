<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date',
    ];
    
    public function parties()
    {
        return $this->belongsToMany(Party::class, 'election_parties', 'election_id', 'party_id');
    }

}
