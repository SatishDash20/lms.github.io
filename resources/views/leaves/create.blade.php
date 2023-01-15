<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add User Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
@guest
<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}">Login</a>
</li>
<li class="nav-item">
<a class="nav-link" href="{{ route('register-user') }}">Register</a>
</li>
@else
<li class="nav-item">
<a class="nav-link" href="{{ route('signout') }}">Logout</a>
</li>
<li class="nav-item">
<a class="nav-link" href="{{ route('users.index') }}">User List</a>
</li>
@endguest
</ul>
</div>
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left mb-2">
<h2>Add User</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
</div>
</div>
</div>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif
<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>User Type:</strong>
<select type="usertype" name="usertype" class="form-control" onchange="return checkEmployee(this.value);">
<option value="">Select User type</option>
<option value="2">Supervisor</option>
<option value="3">Employee</option>
</select>
@error('usertype')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12" id="supervisors" style="display:none;">
<div class="form-group">
<strong>Supervisor:</strong>
<select type="supervisor_id" name="supervisor_id" class="form-control">
<option value="">Select Supervisor</option>
@foreach ($data as $datas)
<option value="{{ $datas->id }}">
{{ $datas->name }}
</option>
@endforeach
</select>
@error('usertype')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>User Name:</strong>
<input type="text" name="name" class="form-control" placeholder="User Name">
@error('name')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>User Email:</strong>
<input type="email" name="email" class="form-control" placeholder="User Email">
@error('email')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Password:</strong>
<input type="password" name="password" class="form-control" placeholder="User Password">
@error('password')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<button type="submit" class="btn btn-primary ml-3">Submit</button>
</div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
function checkEmployee(usertype)
{
	if(usertype == 3)
	{
		$('#supervisors').show();
	}
	else
	{
		$('#supervisors').hide();
	}
}
</script>
</body>
</html>