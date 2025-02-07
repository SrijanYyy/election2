<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['user_id', 'party_id', 'leader_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    public function leader()
    {
        return $this->belongsTo(Leader::class);
    }
}
