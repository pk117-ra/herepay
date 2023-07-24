<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HerePay</title>
    <link rel="stylesheet" href="{{ URL::asset('/assets/style.css') }}">
    <link rel="stylesheet" href=
"https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"  referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="">
    <a class="navbar-brand" href="#">Students Details</a> 
</nav>
<div class="container d-flex mt-4" >
    <div class="row">
        <div class="card">
            <div class="col-md-12">
                @if(count($errors) > 0)
                <div class = "alert alert-danger">
                    upload Validation Error<br<br>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($message = Session::get('success'))
                    <div class = "alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <h4>{{$message}}</h4>
                    </div>
                @endif
                <form id="formdata" method="post" enctype="multipart/form-data" action="{{ route('students') }}">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <h1>Upload From File<span class="spantext">(csv,xlsx only)</span></h2><a href="{{ URL::asset('/assets/herepaycsv.csv') }}">Download Sample File</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="file" class="form-control" id="exampleFormControlInput1" 
                                name="student_data" accept=".xlsx,.csv" required >
                            </div>
                        
                            <div class="col-md-4">
                                <button type="submit" name="upload" value="upload" class="btn btn-primary">Upload</button>
                            </div>

                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger removeFile">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table" id="tableID"  style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Level</th>
                        <th>Parent Contact</th>
                    </tr>
                    @foreach($data as $studentDetails)
                    <tr>
                        <td>{{$studentDetails->id}}</td>
                        <td>{{$studentDetails->name}}</td>
                        <td>{{$studentDetails->class}}</td>
                        <td>{{$studentDetails->level}}</td>
                        <td>{{$studentDetails->parent_contact_no}}</td>
                    </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
</div>
</body>
<script type=”text/javascript” src=”https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js”></script>
<script>
$(document).ready(function(){
		$('.removeFile').click(function(){	
            $('#formdata input[type="file"]').val('');
        });
    });
</script>
</html>