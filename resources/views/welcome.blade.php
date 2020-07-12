<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>User Interface</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
<div class="container">
<div class="row d-flex justify-content-center">
<div class="col-md">
<div class="card">
<div class="card-header">
User Interface
</div>
<div class="card-body">
    @if(session()->has('success'))
    <div class="alert alert-success">
{{session()->get('success')}}
    </div>
    @endif
<form action="{{route('importCSV')}}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="form-group">
    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <div class="form-group">
<button class="btn btn-primary" type="submit">IMPORT</button>
  </div>
</form>
<br>
<div>
    @if($users->count()>0)
<table class="table">
    <thead>
<tr>
    <th>CientDeal ID</th>
    <th>Client ID</th>
    <th>Client Name</th>
    <th>Deal ID</th>
    <th>Deal Name</th>
    <th>Date</th>
    <th>Accepted</th>
    <th>Refused</th>


</tr>
    </thead>
<tbody>
@foreach($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->client_id}}</td>
        <td>{{$user->client_name}}</td>
        <td>{{$user->deal_id}}</td>
        <td>{{$user->deal_name}}</td>
        <td>{{$user->date}}</td>
        <td>{{$user->accepted}}</td>
        <td>{{$user->refused}}</td>

    </tr>
    @endforeach
   

</tbody>
</table>
@endif
</div>  
</div>
<div class="card-footer">
    @if($users->count()>0)
<form action="{{route('reset')}}" method="GET">
@csrf
<div>
    <button class="btn btn-danger">Reset All</button>
</div>
</form>
@endif
<br>

{{$users->links()}}

</div>
</div>
</div>
</div>
</div>
    </body>
</html>
