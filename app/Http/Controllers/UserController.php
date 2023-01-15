<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
	$data['users'] = User::where('usertype','!=','1')->orderBy('id','desc')->paginate(5);
	return view('users.index', $data);
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
	$list = User::where('usertype','=',2)->get();
    return view('users.create')->with('data', $list);
	
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
'usertype' => 'required',
'name' => 'required',
'password' => 'required|same:con_password',
'con_password' => 'required',
'email' => 'required|email'
]);
$user = new User;
$user->name = $request->name;
$user->email = $request->email;
$user->password = Hash::make($request->password);
$user->usertype = $request->usertype;
if(isset($request->supervisor_id))
{
	$user->supervisor_id = $request->supervisor_id;
}
$user->holidays = 5;
$user->save();
return redirect()->route('users.index')
->with('success','User has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\user  $user
* @return \Illuminate\Http\Response
*/
public function show(User $user)
{
return view('users.show',compact('user'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\User  $user
* @return \Illuminate\Http\Response
*/
public function edit(User $user)
{
	return view('users.edit',compact('user'));
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
return redirect()->route('users.index')
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
	$users = DB::select('select * from users WHERE id = "'.$user->id.'"');
	
	$employees = DB::select('select * from users WHERE supervisor_id = "'.$user->id.'"');
	if(empty($employees))
	{
		$user->delete();
		return redirect()->route('users.index')->with('success','User has been deleted successfully');
	}
	else
	{
		return redirect()->route('users.index')->with('error','Warning ! Please delete the employees assigned to this superviser.');
	}
}
}