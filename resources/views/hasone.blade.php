@extends('layout')

@section('title', 'Laravel Crud')

@section('sidebar')
    @parent

  
   
@endsection

@section('content')

<h2>All Students Fee</h2>
<a href="{{ '/' }}"><button class="btn btn-success">Back</button></a>
  <table class="table table-bordered">
    <thead>
      <tr>
     
        <th>ID</th>
        <th>Name</th>
        <th>Fee (fee is not dynamic this dirct insertion )</th>
       
      </tr>
    </thead>
    <tbody>
     
      @foreach($users as $stu)
      <tr>
      
        <td>{{ ++$i }}</td>
        <td>{{ $stu->name }}</td>
        <td>{{ $stu->fee }}</td>
       
      </tr>
     @endforeach
    </tbody>
  </table>
@endsection