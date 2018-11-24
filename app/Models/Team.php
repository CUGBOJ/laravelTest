<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contest;
use App\Models\User;

class Team extends Model
{
    protected $fillable = [
       'teamname',
       'number'
    ];

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'contest_user', 'team_id', 'user_id');
    }
}