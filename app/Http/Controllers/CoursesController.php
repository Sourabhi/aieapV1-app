<?php

namespace aieapV1\Http\Controllers;

use Illuminate\Http\Request;
use aieapV1\Http\Requests\CreateCourseDayRequest;
use aieapV1\Http\Requests;
use aieapV1\Http\Requests\UpdateCourseDayRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use aieapV1\Role;
use aieapV1\User; 
use aieapV1\Course;
use aieapV1\Student;
use aieapV1\Day;  
use aieapV1\Timeslot;
use aieapV1\QueryVisitor; 
class CoursesController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $students = Student::all();
        $courses = Course::all();
        $days = Day::all();
        $timeslots = Timeslot::all();
        $roles=Role::all();
        $users = User::all(); 
        $queryvisitors=QueryVisitor::all();

         
        return view('admin_dash')->withQueryvisitors($queryvisitors)->withCourses($courses)->withDays($days)->withTimeslots($timeslots)->withStudents($students)->withRoles($roles)->withUsers($users);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        $days = Day::all();
       
        return view ('aieap.course_day_form')->withCourses($courses)->withDays($days);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCourseDayRequest $request)
    {   
        $course = new Course;
        $course->course=$request->course;
        $course->start_date=$request->start_date;
        $course->completion_date=$request->completion_date;
        $course->save();
        $course->days()->sync($request->days, false);
        

        return redirect('/course');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data= array(
            
           'course'=> Course::find($id)
          


            );
        return view('single_course',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
         $course= Course::find($id);
         $days= Day::all();
         $days1=array();
         foreach ($days as $day){
            $days1[$day->id]=$day->day;
         }
        return view ('aieap.edit_course_day_form')->withCourse($course)->withDays($days1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseDayRequest $request, $id)
    {
        $course=Course::find ($id);
       $course->course=Input::get ('course');
       
       $course->save();

        $course->days()->sync($request->days );

        return redirect('/course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course= Course::find($id);
       $course->delete();
       return redirect ('/course');
    }
}
