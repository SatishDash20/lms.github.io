<!DOCTYPE html>
<html>
<head>
<title>Apply For Leave</title>
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
<nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
<div class="container">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
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
<a data-toggle="dropdown" class="dropdown-toggle" a href="#">Employee </b></a>
<ul class="dropdown-menu">
<li><a href="{{ route('signout') }}">Logout</a></li>
</ul>
</li>
@endguest
</ul>
</div>
</div>
</nav>
<div class="container mt-2">
<div class="row mt-2">
<div class="col-lg-12 margin-tb">
<div class="pull-left mb-2">
<h2>Apply For Leave</h2>
</div>
<div class="pull-right text-right">
<a class="btn btn-info" href="/employee-dashboard"> Back</a>
</div>
</div>
</div>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif
<form action="" method="POST" enctype="multipart/form-data">
@csrf
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="form-group">
				<strong>Leave Reason:</strong>
				<input type="text" name="leave_reason" class="form-control" placeholder="Leave Reason">
				@error('leave_reason')
				<span class="text-danger mt-1 mb-1">{{ $message }}</span>
				@enderror
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
		<div class="form-group">
		<strong>Leave Date:</strong>
		<input type="date" name="leave_date" class="form-control" placeholder="Leave Date">
		@error('leave_date')
		<span class="text-danger mt-1 mb-1">{{ $message }}</span>
		@enderror
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
		<button type="submit" class="btn btn-success">Submit</button>
		</div>
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
	}
	else
	{
		$('#supervisors').hide();
	}
}
</script>
</body>
</html>