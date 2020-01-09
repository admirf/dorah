<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    use SoftDeletes;

    protected $fillable = ['text', 'project_id', 'assignee_id', 'status', 'description', 'type', 'points'];

    protected $dates = ['created_at', 'updated_at'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function parent()
    {
        return $this->belongsTo(Issue::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Issue::class, 'parent_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class);
    }
}
