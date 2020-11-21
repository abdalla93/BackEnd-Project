<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }
    public function records()
    {
        return $this->morphMany('App\Models\Record', 'recordable');
    }
}
