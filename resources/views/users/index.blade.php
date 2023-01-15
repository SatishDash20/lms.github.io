<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee List</title>
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
<a data-toggle="dropdown" class="dropdown-toggle" a href="#">HR </b></a>
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
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Employee List</h2>
</div>
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('users.create') }}"> Create Employee</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>SL#</th>
<th>User Type</th>
<th>User Name</th>
<th>User Email</th>
<th width="280px">Action</th>
</tr>
@foreach ($users as $key =>  $user)
<tr>
<td class="text-center">{{ ++$key }}</td>
@if ($user->usertype == 2)
<td class="text-primary">Superviser</td>
@else
<td class="text-info">Employee</td>
@endif
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>
<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">Delete</button>
<div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Delete User</h4>
      </div>
      <div class="modal-body">
		<h4 class="modal-title text-center">Are you sure you want to delete this user ?</h4>
      </div>
      <div class="modal-footer">
		<form action="{{ route('users.destroy',$user->id) }}" method="Post">
		@csrf
		@method('DELETE')
        <button type="submit" class="btn btn-success">Yes</button>
		</form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
</td>
<div class="modal fade" id="applicantModal{{$user->id}}" 
tabindex="-1" role="dialog" aria-labelledby="applicantModal">
    <div class="modal-dialog">
    <div class="modal-content">
	{{ $user->name }}
	<button type="submit" class="btn btn-danger">Delete</button>
    </div>
    </div>
</div>
</tr>
@endforeach
@if($users->isEmpty())
<tr class="text-center">
    <td class="text-danger" colspan="5" >No List Found !</td>
</tr>
@endif
</table>
{!! $users->links() !!}
</body>


</html>