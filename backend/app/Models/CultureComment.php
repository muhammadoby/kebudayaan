<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultureComment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function culture() {
        return $this->belongsTo(Culture::class);
    }

    public function parent()
    {
        return $this->belongsTo(CultureComment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CultureComment::class, 'parent_id');
    }
}
