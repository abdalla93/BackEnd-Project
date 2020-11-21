<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalStage extends Model
{
    use HasFactory;
    public function teachers()
    {
        return $this->hasMany('App\Models\Teacher');
    }
    public function subjects()
    {
        return $this->hasManyThrough('App\Models\Subject', 'App\Models\Teacher');
    }
    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }
}
