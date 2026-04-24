<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrashProject extends Model
{
    protected $table = 'trash_projects';
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'owner',
        'tlimit',
        'comment',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
