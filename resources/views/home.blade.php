@extends('layout')

@section('title', 'Laravel Crud')

@section('sidebar')
    @parent

   
@endsection

@section('content')
 <h2>Registration Form</h2>
@if(Session::has('success'))
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
 @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form action="/register">
  	@csrf
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">

    </div>
    <div class="form-group">
      <label for="pwd">Mobile:</label>
      <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile No." name="mobile">
    </div>
     <div class="form-group">
      <label for="pwd">Qualification:</label>
      <select class="form-control" id="qualification" name="qualification">
      	<option> </option>
      	<option value="B-Tech">B-Tech </option>
      	<option value="BCA">BCA </option>
      </select>
    </div>
     <div class="form-group">
      <label for="pwd">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter address." name="address">
    </div>

    <input type="hidden" name="id" id="id">
    <button type="submit" id="btn" class="btn btn-default">Submit</button>
  </form>

  <h2>All Students</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Qualification</th>
        <th>Address</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($students as $student)
      <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->mobile }}</td>
        <td>{{ $student->qualification }}</td>
        <td>{{ $student->address }}</td>
        <td><button class="btn btn-danger" onclick="deleteData('{{$student->id}}')">Delete</button><button class="btn btn-success" onclick="getData('{{$student->id}}')">Edit</button></td>
      </tr>
     @endforeach
    </tbody>
  </table>
  <div>{{ $students ->links()}}</div>
<a href="{{ '/hasone' }}"><button class="btn btn-success">Hasone relation</button></a>
  <script type="text/javascript">
  	function deleteData(id)
  	{
   // alert(id)
        var cnf=confirm("Are You sure want to delete !");
      if(cnf==true){
        $.ajax({
            type: "DELETE",
            method:"get",
            url: "{{ '/deleteData' }}",
            cache:false,
            data: {
            	_token: '{{ csrf_token() }}',
            	id :id
            },
            success: function (data) {
               alert(data);
               window.location.href="{{'/'}}";
            }
           
        });
   }
  }
  	function getData(id)
  	{
    //alert(id)
       
        $.ajax({
            type: "GETDATA",
            method:"get",
            url: "{{ '/getData' }}",
            cache:false,
            dataType:"json",
            data: {
            	_token: '{{ csrf_token() }}',
            	id :id
            },
            success: function (data) {
              // alert(data.name);
               $("#name").val(data.name);
               $("#mobile").val(data.mobile);
               $("#qualification").val(data.qualification);
               $("#address").val(data.address);
               $("#id").val(data.id);
               $("#btn").text("Update");

              // window.location.href="{{'/register'}}";
            }
           
        });
   
  }
  </script>
@endsection