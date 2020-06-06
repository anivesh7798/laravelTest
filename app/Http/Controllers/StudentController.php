<?php

namespace App\Http\Controllers;
use App\Student;
use App\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{
    public function index()
    {
    	$students=Student::latest()->paginate(5);
    	return view('home',compact('students'))->with('i',(request()->input('page',1)-1)*5);
    }
    public function create(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'mobile' => 'required|numeric|between:9,11',
        'qualification' => 'required',
        'address' => 'required',
    ]);
    $id=$request->input('id');
    if($id){
    Student::find($id)->update($request->all());
    }else{
   $data= Student::create($request->all());
   $std_id=$data->id;
   $feeData = array('student_id' =>$std_id,'fee'=>'500' );
   Fee::create($feeData);
   }
     return redirect('/')->with('success', 'You are successfully registered'); 
    }
    public function destory(Request $request)
    {
	 $id=$request->input('id');
	 Student::find($id)->delete();
	 echo "Data deletted";

    }
    public function fetchData(Request $request)
    {
    $id=$request->input('id');
	 $data=Student::find($id);
	 echo json_encode($data);

    }

    public function show()
     {
    	$users = DB::table('students')
            ->join('fees', 'students.id', '=', 'fees.student_id')
            ->select('students.*', 'fees.fee')
            ->get();
       // dd($users);
   return view('/hasone', compact('users'))->with('i',(request()->input('page',1)-1)*5); 
    }
}
