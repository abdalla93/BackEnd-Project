<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function educationalStage()
    {
        return $this->belongsTo('App\Models\EducationalStage');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }
    public function chapters()
    {
        return $this->hasManyThrough('App\Models\Chapter', 'App\Models\Subject');
    }

}
