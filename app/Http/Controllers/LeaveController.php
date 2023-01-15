<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Leave;
use DB;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
	$user_id = Session::get('user_id');
	$data['leaves'] = Leave::where('employee_id','=',$user_id);
	//echo $user_id;
	$leaves = DB::select('select * from leaves WHERE employee_id = "'.$user_id.'"');
	//print_r($users); exit;
	//print_r($data['leaves']); exit;
	return view('leaves.index',['leaves'=>$leaves]);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
	//$data['supervisors'] = User::where('usertype','=','2')->orderBy('id','desc');
	//dd($data); exit;
	$list = Leave::where('usertype','=',2)->get();
    return view('leaves.create')->with('data', $list);
	
	//return view('users.create', $data);
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$request->validate([
'superviser_id' => 'required',
'leave_date' => 'required',
'employee_id' => 'required'
]);
$leave = new Leave;
$leave->superviser_id = $request->superviser_id;
$leave->leave_date = $request->leave_date;
$leave->employee_id = $request->employee_id;
$leave->save();
return redirect()->route('leaves.index')
->with('success','User has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\user  $user
* @return \Illuminate\Http\Response
*/
public function show(Leave $leave)
{
return view('leaves.show',compact('user'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\User  $user
* @return \Illuminate\Http\Response
*/
public function edit(User $user)
{
	return view('leaves.edit',compact('user'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\user  $user
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$request->validate([
'name' => 'required',
'email' => 'required',
]);
$user = User::find($id);
$user->name = $request->name;
$user->email = $request->email;
$user->save();
return redirect()->route('leaves.index')
->with('success','User Has Been updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  \App\User  $user
* @return \Illuminate\Http\Response
*/
public function destroy(User $user)
{
$user->delete();
return redirect()->route('leaves.index')
->with('success','User has been deleted successfully');
}
}