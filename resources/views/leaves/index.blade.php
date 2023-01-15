<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Leave List</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
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
<li class="nav-item">
<a class="nav-link" href="{{ route('signout') }}">Logout</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/dashboard">Dashboard</a>
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
<h2>Leave List</h2>
</div>
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('leaves.create') }}"> Apply For Leave</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>Reason</th>
<th>Date</th>
<th width="280px">Action</th>
</tr>
@foreach ($leaves as $leave)
<tr>
<td>{{ $leave->leave_reason }}</td>
<td>{{ $leave->leave_date }}</td>
</tr>
@endforeach
</table>
</body>


</html>