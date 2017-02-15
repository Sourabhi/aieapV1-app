<?php

namespace aieapV1\Http\Controllers;

use Illuminate\Http\Request;

use aieapV1\Http\Requests;
use aieapV1\Http\Requests\CreateStudentEnrolmentRequest;

use aieapV1\Http\Requests\UpdateStudentEnrolmentRequest;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use aieapV1\Role;
use aieapV1\User; 
use aieapV1\Course;
use aieapV1\Student;
use aieapV1\StudentImage;
use aieapV1\Day;  
use aieapV1\Timeslot;
use aieapV1\QueryVisitor;
use File;
use Croppa;
class StudentsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $students = Student::all();
        $courses = Course::all();
       
        return view ('aieap.enrolment_form')->withStudents($students)->withCourses($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudentEnrolmentRequest $request)
    {   //dd($request);
        $student = new Student;
        $student->title=$request->title;
        $student->first_name=$request->first_name;
        $student->last_name=$request->last_name;
        $student->date_of_birth=$request->date_of_birth;
        $student->gender=$request->gender;
        $student->house_no=$request->house_no;
        $student->town=$request->town;
        $student->state=$request->state;
        $student->postcode=$request->postcode;
        $student->country=$request->country;
        $student->nationality=$request->nationality;
        $student->phone=$request->phone;
        $student->email=$request->email;
        $student->comments=$request->comments;
        $student->user_id=Auth::id();
        $student->save();
        if(Input::hasFile('image')){
            $image=new StudentImage;
            $image->filename=Input::file('image')->getClientOriginalName();
            $image->path=sha1(uniqid(mt_rand(),True)).".".Input::file('image')->getClientOriginalExtension();
            $image->student_id=$student->id;

            Input::file('image')->move(public_path().'/uploads/images',$image->path);
            $image->save();

        }
        $student->courses()->sync($request->courses, false);

        return redirect('/enrolment_confirm')->withStudent($student);
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
            
           'student'=> Student::find($id)
          
            );
        return view('admin_single_student_info',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $student= Student::find($id);
         $courses= Course::all();
         $courses1=array();
         foreach ($courses as $course){
            $courses1[$course->id]=$course->course;
         }
        return view ('aieap.edit_student_profile_form')->withStudent($student)->withCourses($courses1);
         
        
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentEnrolmentRequest $request, $id)
    {
        $student=Student::find ($id);
        $student->title=Input::get ('title');
        $student->first_name=Input::get ('first_name');
        $student->last_name=Input::get ('last_name');
        $student->date_of_birth=Input::get ('date_of_birth');
        $student->gender=Input::get ('gender');
        $student->house_no=Input::get ('house_no');
        $student->town=Input::get ('town');
        $student->state=Input::get ('state');
        $student->postcode=Input::get ('postcode');
        $student->country=Input::get ('country');
        $student->nationality=Input::get ('nationality');
        $student->phone=Input::get ('phone');
        $student->email=Input::get ('email');
        $student->comments=Input::get ('comments');

        $student->save();

        if(Input::hasFile('image')){
            $image=new StudentImage;
            $image->filename=Input::file('image')->getClientOriginalName();
            $image->path=sha1(uniqid(mt_rand(),True)).".".Input::file('image')->getClientOriginalExtension();
            $image->student_id=$student->id;

            Input::file('image')->move(public_path().'/uploads/images',$image->path);
            $image->save();

        }

        $student->courses()->sync($request->courses );

        return redirect('/admin_dash')->with('success','Profile has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student= Student::find($id);
       $student->delete();

       foreach($student->images as $image)
        {
            if(File::exists(public_path().'/uploads/images/'. $image->path))
                { 
                    //File::delete(public_path().'/uploads/images/'. $image->path);
                    Croppa::delete(public_path().'/uploads/images/'. $image->path);
                    $image->delete();

                }

        }
       return redirect ('/admin_dash')->with('success','Student profile with Photo has been deleted');


    } 


    

    public function getImage($id)
    { //Find the image, show it, confirm delete.
     $data = array('image' => StudentImage::find($id));
        return view ('aieap.image',$data);
    }

    public function deleteImage($id)
    {
      //Delete image from server and ddatabase.
    // return " Ready to Delete";
          $image=StudentImage::find($id);
          if(File::exists(public_path().'/uploads/images/'. $image->path))
            {
            File::delete(public_path().'uploads/images/'. $image->path);
            $image->delete();
            }
             return redirect('/admin_dash')->with('success','Photo has been deleted.');
        
    }



}
