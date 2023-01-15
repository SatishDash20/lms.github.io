<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{
public function index()
{
return view('auth.login');
}
public function customLogin(Request $request)
{
$request->validate([
'email' => 'required',
'password' => 'required',
]);

$credentials = $request->only('email', 'password');
if (Auth::attempt($credentials)) {
	$user = Auth::user();
	$Loggedin_usertype = $user->usertype;
	Session::put('user_id', $user->id);
	if($Loggedin_usertype == 1)
	{
		return redirect()->intended('users')->withSuccess('Signed in');
	}
	else if($Loggedin_usertype == 2)
	{
		return redirect()->intended('supervisor-dashboard')->withSuccess('Signed in');
	}
	else
	{
		return redirect()->intended('employee-dashboard')->withSuccess('Signed in');
	}
}

return redirect("login")->withSuccess('Login details are not valid');
}

public function registration()
{
return view('auth.registration');
}


public function customRegistration(Request $request)
{
$request->validate([
'name' => 'required',
'email' => 'required|email|unique:users',
'password' => 'required|min:6',
]);

$data = $request->all();
$check = $this->create($data);

return redirect("dashboard")->withSuccess('You have signed-in');
}


public function create(array $data)
{
return User::create([
'usertype' => 1,
'name' => $data['name'],
'email' => $data['email'],
'password' => Hash::make($data['password']),
'holidays' => 5,
]);
}
public function dashboard()
{
	if(Auth::check()){
	return view('auth.dashboard');
	}

	return redirect("login")->withSuccess('You are not allowed to access');
}
public function supervisordashboard()
{
	if(Auth::check()){
		$user_id = Session::get('user_id');
		//$data['leaves'] = Leave::where('employee_id','=',$user_id);
		//echo $user_id;
		$leaves = DB::select('select * from leaves WHERE superviser_id = "'.$user_id.'"');
		//print_r($leaves);
		$appliedleave = array();
		$appliedleaveresult = array();
		foreach($leaves as $leave)
		{
			$appliedleaveresult['id'] = $leave->id;
			$appliedleaveresult['superviser_id'] = $leave->superviser_id;
			$appliedleaveresult['employee_id'] = $leave->employee_id;
			$users = DB::select('select * from users WHERE id = "'.$leave->employee_id.'"');
			$appliedleaveresult['employee_name'] = $users[0]->name;
			$appliedleaveresult['leave_reason'] = $leave->leave_reason;
			$appliedleaveresult['leave_date'] = $leave->leave_date;
			$appliedleaveresult['leave_status'] = $leave->leave_status;
			$appliedleaveresult['created_at'] = $leave->created_at;
			$appliedleave[] = $appliedleaveresult;
		}
		$object = json_decode(json_encode($appliedleave));
		//print_r($appliedleave); exit;
		//print_r($data['leaves']); exit;
		return view('auth.supervisordashboard',['leaves'=>$object]);
		//return response()->json($result);
		//return view('auth.supervisordashboard');
	}
	return redirect("login")->withSuccess('You are not allowed to access');
}
public function acceptleave(Request $request, $leave_id)
{
	if(Auth::check()){
		$leaves = DB::select('select * from leaves WHERE id = "'.$leave_id.'"');
		$users = DB::select('select * from users WHERE id = "'.$leaves[0]->employee_id.'"');
		$TotalLeaves = $users[0]->holidays;
		$update = \DB::table('leaves') ->where('id', $leave_id) ->limit(1) ->update( [ 'leave_status' => 1 ]);
		$update = \DB::table('users') ->where('id', $leaves[0]->employee_id) ->limit(1) ->update( [ 'holidays' => $TotalLeaves - 1 ]);
	}
	return redirect("supervisor-dashboard")->withSuccess('Leave accepted successfully');
}
public function declineleave(Request $request, $leave_id)
{
	if(Auth::check()){
		$leaves = DB::select('select * from leaves WHERE id = "'.$leave_id.'"');
		$users = DB::select('select * from users WHERE id = "'.$leaves[0]->employee_id.'"');
		$TotalLeaves = $users[0]->holidays;
		$update = \DB::table('leaves') ->where('id', $leave_id) ->limit(1) ->update( [ 'leave_status' => 2 ]); 
		$update = \DB::table('users') ->where('id', $leaves[0]->employee_id) ->limit(1) ->update( [ 'holidays' => $TotalLeaves + 1 ]);
	}
	return redirect("supervisor-dashboard")->withSuccess('Leave declined successfully');
}
public function employeedashboard()
{
	if(Auth::check()){
		$user_id = Session::get('user_id');
		//$data['leaves'] = Leave::where('employee_id','=',$user_id);
		//echo $user_id;
		$leaves = DB::select('select * from leaves WHERE employee_id = "'.$user_id.'"');
		//print_r($leaves);
		$appliedleave = array();
		$appliedleaveresult = array();
		foreach($leaves as $leave)
		{
			$appliedleaveresult['id'] = $leave->id;
			$appliedleaveresult['superviser_id'] = $leave->superviser_id;
			$appliedleaveresult['employee_id'] = $leave->employee_id;
			$users = DB::select('select * from users WHERE id = "'.$leave->superviser_id.'"');
			$appliedleaveresult['superviser_name'] = $users[0]->name;
			$appliedleaveresult['leave_reason'] = $leave->leave_reason;
			$appliedleaveresult['leave_date'] = $leave->leave_date;
			$appliedleaveresult['leave_status'] = $leave->leave_status;
			$appliedleaveresult['created_at'] = $leave->created_at;
			$appliedleave[] = $appliedleaveresult;
		}
		$object = json_decode(json_encode($appliedleave));
		//print_r($appliedleave); exit;
		//print_r($data['leaves']); exit;
		return view('auth.employeedashboard',['leaves'=>$object]);
		//return view('auth.employeedashboard');
	}
	return redirect("login")->withSuccess('You are not allowed to access');
}


public function signOut() {
Session::flush();
Auth::logout();

return Redirect('login');
}

public function applyleave()
{
	if(Auth::check()){
	$list = User::where('usertype','=',2)->get();
    return view('auth.applyleave')->with('data', $list);
	//return view('auth.applyleave');
	}
	return redirect("login")->withSuccess('You are not allowed to access');
}
public function saveapplyleave(Request $request)
{
	if(Auth::check()){
	$request->validate([
	'leave_reason' => 'required',
	'leave_date' => 'required'
	]);
	$user_id = Session::get('user_id');
	$users = DB::select('select * from users WHERE id = "'.$user_id.'"');
	if($users[0]->holidays > 0)
	{
		$supervisor_id = $users[0]->supervisor_id;
		$leave_reason = $request->leave_reason;
		$leave_date = $request->leave_date;
		DB::table('leaves')->insert(
			['superviser_id' => $supervisor_id, 'employee_id' => $user_id, 'leave_reason' => $leave_reason, 'leave_date' => $leave_date, 'leave_status' => 0]
		);
		$TotalLeaves = $users[0]->holidays;
		\DB::table('users') ->where('id', $user_id) ->limit(1) ->update( [ 'holidays' => $TotalLeaves - 1 ]);
		return redirect('/employee-dashboard')->with('success','Your leave application submitted successfully');
	}
	else
	{
		return redirect('/employee-dashboard')->with('error','Oops! You are out of holiday counts');
	}
    return view('auth.applyleave')->with('data', $list);
	//return view('auth.applyleave');
	}
	return redirect("login")->withSuccess('You are not allowed to access');
}
}