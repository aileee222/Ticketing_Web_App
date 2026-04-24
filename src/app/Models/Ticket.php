<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{   
    protected $table = 'tickets';
    protected $fillable = [
        'name',
        'fromproject',
        'description',
        'tlimit',
        'comment',
        'invoicing',
        'status',
        'user_id',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
