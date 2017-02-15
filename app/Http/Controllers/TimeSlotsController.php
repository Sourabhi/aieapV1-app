<?php

namespace aieapV1\Http\Controllers;

use Illuminate\Http\Request;
use aieapV1\Http\Requests\CreateTimeslotRequest;
use aieapV1\Http\Requests;
use aieapV1\Timeslot;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use aieapV1\Role;
use aieapV1\User; 
use aieapV1\Course;
use aieapV1\Student;
use aieapV1\Day;  
use aieapV1\QueryVisitor;
class TimeSlotsController extends Controller
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
        return view ('aieap.timeslot_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTimeslotRequest $request)
    {
        

       $timeslot=new Timeslot;
       $timeslot->timeslot=Input::get ('timeslot');
       $timeslot->starttime=Input::get ('starttime');
       $timeslot->endtime=Input::get ('endtime');
       $timeslot->save();
       return redirect('/timslot');

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
            
           'timeslot'=> Timeslot::find($id)
          


            );
        return view('single_timeslot',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= array ('timeslot'=> Timeslot::find($id));
        return view ('aieap.edit_timeslot',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeslotRequest $request, $id)
    {
        $timeslot=Timeslot::find ($id);
        $timeslot->title=Input::get ('title');
       $timeslot->starttime=Input::get ('starttime');
       $timeslot->endtime=Input::get ('endtime');
       $timeslot->save();
       return redirect('/timslot');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timeslot= Timeslot::find($id);
       $timeslot->delete();
       return redirect ('/timslot');
    }
}