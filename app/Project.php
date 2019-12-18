<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description'];

    protected $dates = ['created_at', 'updated_at'];

    public function sprints()
    {
        return $this->hasMany(Sprint::class);
    }

    public function getAssignedUsersAttribute()
    {
        return collect([$this->user]);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

/*    public function users()
    {
        return $this->belongsToMany('')
    }*/
}
