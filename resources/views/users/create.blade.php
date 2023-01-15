<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add User Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>

<!-- Font Awesome JS -->
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"> </script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"> </script>
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
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
<li class="dropdown">
<a data-toggle="dropdown" class="dropdown-toggle" a href="#">HR </b></a>
<ul class="dropdown-menu">
<li><a href="{{ route('signout') }}">Logout</a></li>
</ul>
</li>
@endguest
</ul>
</div>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left mb-2">
<h2>Add User</h2>
</div>
<div class="pull-right">
<a class="btn btn-info" href="{{ route('users.index') }}"> Back</a>
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
<div class="col-xs-6 col-sm-6 col-md-6">
<div class="form-group">
<strong>User Type:</strong>
<select type="usertype" name="usertype" class="form-control" style="height: calc(2.25rem + 12px) !important;" onchange="return checkEmployee(this.value);">
<option value="">Select User type</option>
<option value="2">Supervisor</option>
<option value="3">Employee</option>
</select>
@error('usertype')
<span class="text-danger mt-1 mb-1">{{ $message }}</span>
@enderror
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" id="supervisors" style="display:none;">
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
@error('supervisor_id')
<span class="text-danger mt-1 mb-1">{{ $message }}</span>
@enderror
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
<div class="form-group">
<strong>User Name:</strong>
<input type="text" name="name" class="form-control" placeholder="User Name">
@error('name')
<span class="text-danger mt-1 mb-1">{{ $message }}</span>
@enderror
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
<div class="form-group">
<strong>User Email:</strong>
<input type="email" name="email" class="form-control" placeholder="User Email">
@error('email')
<span class="text-danger mt-1 mb-1">{{ $message }}</span>
@enderror
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
<div class="form-group">
<strong>Password:</strong>
<input type="password" name="password" class="form-control" placeholder="User Password">
@error('password')
<span class="text-danger mt-1 mb-1">{{ $message }}</span>
@enderror
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
<div class="form-group">
<strong>Confirm Password:</strong>
<input type="password" name="con_password" class="form-control" placeholder="User Password">
@error('con_password')
<span class="text-danger mt-1 mb-1">{{ $message }}</span>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
function checkEmployee(usertype)
{
	if(usertype == 3)
	{
		$('#supervisors').show();
		$('#supervisors').css("height","calc(2.25rem + 12px)");
	}
	else
	{
		$('#supervisors').hide();
	}
}
</script>
</body>
</html>