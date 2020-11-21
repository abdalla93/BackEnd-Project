<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
    public function educationalStages()
    {
        return $this->hasManyThrough('App\Models\EducationalStage','App\Models\Teacher');
    }
    public function records()
    {
        return $this->morphMany('App\Models\Record', 'recordable');
    }
}
