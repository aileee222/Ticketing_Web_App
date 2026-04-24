<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
	protected $table = 'calendar_events';
	protected $fillable = [
		'name',
		'description',
		'start',
		'end',
		'user_id',
	]; 

	public function user() {
        return $this->belongsTo(User::class);
    }
}
