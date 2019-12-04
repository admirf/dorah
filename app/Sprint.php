<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $dates = ['started_at', 'ends_at', 'created_at', 'updated_at'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
