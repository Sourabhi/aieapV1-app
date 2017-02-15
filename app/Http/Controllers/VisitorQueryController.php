<?php

namespace aieapV1\Http\Controllers;

use Illuminate\Http\Request;

use aieapV1\Http\Requests;
use aieapV1\Http\Requests\CreateVisitorQueryRequest;
use aieapV1\Http\Requests\UpdateVisitorQueryRequest;
use aieapV1\Http\Requests\UpdateInfoUserRequest;
use aieapV1\QueryVisitor;
use Illuminate\Support\Facades\Input;

class VisitorQueryController extends Controller
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
        return view ('aieap.contact_us');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVisitorQueryRequest $request)
    {
       

       $visitor=new QueryVisitor;
       $visitor->first_name=Input::get ('first_name');
       $visitor->last_name=Input::get ('last_name');
        $visitor->email=Input::get ('email');
       $visitor->phone=Input::get ('phone');
        $visitor->nationality=Input::get ('nationality');
       $visitor->message=Input::get ('message');
       $visitor->save();
       return redirect('/query_confirm');

      /*return  ('Thank you for submitting your query. AIEAP will contact you regarding your query');*/
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
            
           'visitor'=> QueryVisitor::find($id)
           /*'infouser'=> InfoUser::where('UserId', $id)*/


            );
        return view('single_visitor_query',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data= array ('visitor'=> QueryVisitor::find($id));
        return view ('aieap.edit_visitor_query',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVisitorQueryRequest $request, $id)
    {
      $visitor=QueryVisitor::find ($id);
       $visitor->first_name=Input::get ('first_name');
       $visitor->last_name=Input::get ('last_name');
        $visitor->email=Input::get ('email');
       $visitor->phone=Input::get ('phone');
        $visitor->nationality=Input::get ('nationality');
       $visitor->message=Input::get ('message');
       $visitor->save();
       return redirect('/visitor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
       $visitor= QueryVisitor::find($id);
       $visitor->delete();
       return redirect ('/visitor');

    }
}
