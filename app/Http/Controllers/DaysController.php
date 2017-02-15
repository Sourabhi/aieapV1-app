<?php

namespace aieapV1\Http\Controllers;

use Illuminate\Http\Request;
use aieapV1\Http\Requests\CreateDayTimeslotRequest;
use aieapV1\Http\Requests;
use aieapV1\Http\Requests\UpdateDayTimeslotRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use aieapV1\Role;
use aieapV1\User; 
use aieapV1\Course;
use aieapV1\Student;
use aieapV1\Day;  
use aieapV1\Timeslot;
use aieapV1\QueryVisitor;
class DaysController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $students = Student::all();
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
        $days = Day::all();
        $timeslots = Timeslot::all();
        return view ('aieap.day_timeslot_form')->withDays($days)->withTimeslots($timeslots);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDayTimeslotRequest $request)

           {  
       
          $day = new Day;
        $day->day=$request->day;
        
        $day->save();
        $day->timeslots()->sync($request->timeslots, false);

        return redirect('/day');


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
            
           'day'=> Day::find($id)
          


            );
        return view('single_day',$data);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $day= Day::find($id);
         $timeslots= Timeslot::all();
         $timeslots1=array();
         foreach ($timeslots as $timeslot){
            $timeslots1[$timeslot->id]=$timeslot->timeslot;
         }
        return view ('aieap.edit_day_timeslot_form')->withDay($day)->withTimeslots($timeslots1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDayTimeslotRequest $request, $id)
    {
        $day=Day::find ($id);
       $day->day=Input::get ('day');
       
       $day->save();

        $day->timeslots()->sync($request->timeslots );

        return redirect('/day');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $day= Day::find($id);
       $day->delete();
       return redirect ('/day');

    }
}
