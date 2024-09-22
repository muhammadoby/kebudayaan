<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventComment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(EventComment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(EventComment::class, 'parent_id');
    }
}
