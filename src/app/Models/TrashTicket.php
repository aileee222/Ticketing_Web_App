<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrashTicket extends Model
{
    protected $table = 'trash_tickets';
    protected $fillable = [
        'ticket_id',
        'name',
        'fromproject',
        'description',
        'tlimit',
        'comment',
        'invoicing',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
