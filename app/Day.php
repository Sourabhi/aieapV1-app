<?php

namespace aieapV1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Day extends Model
{
    use SoftDeletes;
    protected $table='days';
    protected $dates = ['deleted_at'];
     protected $guarded = [
        'id',
        'day_timeslot',
        'course_day'
    ];
   
    //protected $fillable = array('day_id','timeslot_id');
 public function timeslots()
    {
        return $this->belongsToMany('aieapV1\Timeslot','day_timeslot');

    }

     public function courses()
    {
        return $this->belongsToMany('aieapV1\Course','course_day');

    }
    
}

