<?php

namespace aieapV1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DayTimeslot extends Model
{
     use SoftDeletes;
    protected $table='day_timeslot';
    protected $dates = ['deleted_at'];
    
    protected $guarded = [
        'id',
        'course_day_timeslot'
    ];
    
     public function courses()
    {
        return $this->belongsToMany('aieapV1\Day','course_day_timeslot');
    }

}
