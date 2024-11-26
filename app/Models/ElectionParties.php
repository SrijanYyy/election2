<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectionParties extends Model
{
    // Allow mass assignment for the following attributes
    protected $fillable = ['election_id', 'party_id'];

    /**
     * Define the relationship to the Election model.
     */
    public function election()
    {
        return $this->belongsTo(Election::class); // Linking to the Election model
    }

    public function party()
    {
        return $this->belongsTo(Party::class); // Linking to the Party model
    }

   

  
    
}

