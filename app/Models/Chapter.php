<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public function lessons()
    {
        return $this->hasMany('App\Models\Lessons');
    }
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
    public function records()
    {
        return $this->morphMany('App\Models\Record', 'recordable');
    }
}
