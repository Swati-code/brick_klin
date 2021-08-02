<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center mt-5">Financial Year Details</h1>
		<a href="{{ url('/') }}" class="text-sm text-gray-700 underline">Back</a>
		<hr>
		<div class="row mt-5">
			<div class="col-6 offset-3">
				<form id="year">
					@csrf
					<div class="form-group">
						<label for="">Name:</label>
				        <input type="text" name="name" class="form-control" placeholder="">
					</div>
					<div class="row">
						<div class="col">
						<label class="mr-sm-2">Start Date:</label>
						<input type="Date" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="start">
					</div>
				    <div class="col">
					    <label class="mr-sm-2">End Date:</label>
                        <input type="Date" class="form-control mb-2 mr-sm-2" placeholder="" name="end">
                    </div>
					</div>
					
					<button type="submit" id="submit" class="btn btn-success mt-3 w-100">Submit</button>
				</form>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col">
				<table id="years" class="table table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Name</th>
							<th>Start Year</th>
							<th>End Year</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="updateform">
							   @csrf
							  <input type="text" name="id" value="">
        	                  <!-- <label for="">Bank id</label>
        	                  	<input type="text" name="bank_id" class="form-control"> -->
        	                  	<div>
        	                  		<label for="">Name</label>
        	                  		<input type="text" name="edit_name" class="form-control">
        	                  	</div>
        	                  	<div class="form-group">
        	                  		<label for="">Start Year</label>
        	                  		<input type="Date" name="edit_start" class="form-control">
        	                  	</div>
        	                  	<label for="">End Year</label>
        	                  	<input type="Date" name="edit_end" class="form-control">
        	                </form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" id="update" class="btn btn-primary">Update</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script  src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script>
    	$(document).ready(function(){
    		$('#submit').click(function(e){
    			//Insert Code 
				e.preventDefault();

				$.ajax({
					url:"{{url('addyear')}}",
					type:"post",
					dataType:"json",
					data:$('#year').serialize(),
					success: function(response){
						$('#year')[0].reset();
						console.log(response);
						table.ajax.reload();
					}
				});
			});
			//Data Display Code
			    var table = $("#years").DataTable( {
				ajax: "{{url('getyear')}}",
				columns: [
				{ "data": "id" },
				{ "data": "name" },
				{ "data": "start_year" },
				{ "data": "end_year" },
				{ 
					"data": null,
					render:function(data,row,type){
						return `<button data-id="${data.id}" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit" type="submit"><i class="fa fa-edit"></i></button>`
					}
				},
				{ 
					"data": null,
					render:function(data,row,type){
						return`<button data-id="${data.id}" class="btn btn-danger" id="delete" type="submit"><i class="fa fa-trash"></button>`
					}
				},
				]
			});
			    //edit code is here
			$(document).on('click','#edit',function(){
				
				$.ajax({
					url:"{{url('getyearById')}}",
					type:"post",
					dataType:"json",
					data:{
                        "_token":"{{ csrf_token() }}",
                        "id":$(this).data('id'),
                    },
					success:function(response){
						// console.log(response);
						// console.log(response.data.account_no);
						$('input[name="id"]').val(response.data.id);
						$('input[name="edit_name"]').val(response.data.name);
						$('input[name="edit_start"]').val(response.data.start);
						$('input[name="edit_end"]').val(response.data.end);
					}
				});
			})  
			//Update Code is here
    		$(document).on('click','#update',function(){
            if(confirm('Are you sure you want to update ??')){
                $.ajax({
                    url:'{{url("updateyear")}}',
                    type:'post',
                    dataType:'json',
                    data:$('#updateform').serialize(),
                    success:function(response){
                        $('#updateform')[0].reset();
                        table.ajax.reload();
                        $('#exampleModal').modal('hide');
                    }
                })
            }
        })
    		//Delete Code is here 
          $(document).on('click','#delete',function(){
            if(confirm('Are you sure you want to delete??')){
                $.ajax({
                    url:'{{url("deleteyearById")}}',
                    type:'post',
                    dataType:'json',
                    data:{
                        "_token":"{{ csrf_token() }}",
                        "id":$(this).data('id')
                    },
                    success:function(response){
                        table.ajax.reload();
                    }
                })
            }
          })  
    	})
    </script>
</body>
</html>