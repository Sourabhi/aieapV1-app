<?php

namespace aieapV1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
   use SoftDeletes;
    protected $table='courses';
    protected $dates = ['deleted_at'];
     protected $guarded = [
        'id',
        'course_day'
        
    ];
   
    //protected $fillable = array('day_id','timeslot_id');

     public function days()
    {
        return $this->belongsToMany('aieapV1\Day','course_day');

    }
     
     public function students()
    {
        return $this->belongsToMany('aieapV1\Student','course_student');

    }
}
