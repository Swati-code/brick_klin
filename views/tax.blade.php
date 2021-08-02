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
		<h1 class="text-center mt-3">Tax Details</h1>
		<a href="{{ url('/') }}" class="text-sm text-gray-700 underline">Back</a>
		<hr>
		<div class="row mt-3">
			<div class="col-6 offset-3">
				<form id="tax">
					@csrf
					<div class="form-group">
						<label for="">Name:</label>
				        <input type="text" name="name" class="form-control" placeholder="Enter name">
					</div>
			        <div class="row">
						<div class="col">
							<label class="mr-sm-2">CGST Name:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="cgst_name">
						</div>
						<div class="col">
							<label class="mr-sm-2">SGST Name:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="sgst_name">
						</div>
						<div class="col">
							<label class="mr-sm-2">IGST Name:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="igst_name">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">CGST Tax:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="cgst_amt">
						</div>
						<div class="col">
							<label class="mr-sm-2">SGST Tax:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="sgst_amt">
						</div>
						<div class="col">
							<label class="mr-sm-2">IGST Tax:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="igst_amt">
						</div>
					</div>
					<button type="submit" id="submit" class="btn btn-success mt-3 w-100">Submit</button>
				</form>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col">
				<table id="taxes" class="table table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Name</th>
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
        	                  		<label for="">CGST Name</label>
        	                  		<input type="text" name="edit_cgst" class="form-control">
        	                  	</div>
        	                  	<label for="">SGST Name</label>
        	                  	<input type="text" name="edit_sgst" class="form-control">
        	                  	<label for="">IGST Name</label>
        	                  	<input type="text" name="edit_igst" class="form-control">
        	                  	<label class="mr-sm-2">CGST Tax:</label>
        	                  	<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="edit_camount">
        	                  	<label class="mr-sm-2">CGST Tax:</label>
        	                  	<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="edit_samount">
        	                  	<label class="mr-sm-2">CGST Tax:</label>
        	                  	<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="edit_iamount">
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
				e.preventDefault();
    		$.ajax({
					url:"{{url('addtax')}}",
					type:"post",
					dataType:"json",
					data:$('#tax').serialize(),
					success: function(response){
						$('#tax')[0].reset();
						console.log(response);
						table.ajax.reload();
					}
				});
			});
			//Data Display Code
			    var table = $("#taxes").DataTable( {
				ajax: "{{url('gettax')}}",
				columns: [
				{ "data": "id" },
				{ "data": "name" },
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
					url:"{{url('gettaxById')}}",
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
						$('input[name="edit_cgst"]').val(response.data.cgst_name);
						$('input[name="edit_sgst"]').val(response.data.sgst_name);
						$('input[name="edit_igst"]').val(response.data.igst_name);
						$('input[name="edit_camount"]').val(response.data.cgst_amount);
						$('input[name="edit_samount"]').val(response.data.sgst_amount);
						$('input[name="edit_iamount"]').val(response.data.igst_amount);

						
					}
				});
			})  
			//Update Code is here
    		$(document).on('click','#update',function(){
            if(confirm('Are you sure you want to update ??')){
                $.ajax({
                    url:'{{url("updatetax")}}',
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
                    url:'{{url("deletetaxById")}}',
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