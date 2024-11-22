<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectionParties extends Model
{
       
    protected $fillable = ['election_id', 'party_id'];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }
    
}
