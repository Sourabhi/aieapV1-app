<?php

namespace aieapV1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Student extends Model
{

	 use SoftDeletes;
    protected $table='students';
    protected $dates = ['deleted_at'];
     protected $guarded = [
        'id',
        'course_student'
        ];

        public function courses()
    {
        return $this->belongsToMany('aieapV1\Course','course_student');

    }

     public function images()
    {
        return $this->hasMany('aieapV1\StudentImage','student_id');

    }

    public function users()
    {
        return $this->belongsTo('aieapV1\User');

    }
}
