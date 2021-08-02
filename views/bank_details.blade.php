<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Brick Klin Manager</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center mt-3">Bank Details</h1>
		<a href="{{ url('/') }}" class="text-sm text-gray-700 underline">Back</a>
		<hr>
		<div class="row mt-3">
			<div class="col-6 offset-3">
				<form id="bankform">
					@csrf
					<div class="form-group">
						<label for="">Bank Name:</label>
						<input type="text" name="bank_name" class="form-control" placeholder="Enter bank name"required="">
					</div>
					<div class="form-group">
						<label for="">Account Number:</label>
						<input type="text" name="acc_no" class="form-control" placeholder="Enter account number" required="">
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">IFSC Code:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" name="ifsc_code" placeholder="Enter ifsc code" required="">
						</div>
						<div class="col">
							<label class="mr-sm-2">MICR Code:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" name="micr_code" placeholder="Enter micr code"  required="">
						</div>
					</div>
					<button id="submit" class="btn btn-success mt-3 w-100">Submit</button>
				</form>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col">
				<table id="bank" class="table table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Bank Name</th>
							<th>IFSC Code</th>
							<th>MICR Code</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Bank details</h5>
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
        			<label for="">Bank Name</label>
        			<input type="text" name="edit_name" class="form-control">
        		</div>
        		<div class="form-group">
        			<label for="">Account Number:</label>
        			<input type="text" name="edit_acc" class="form-control">
        		</div>
        		<label for="">IFSC Code</label>
        		<input type="text" name="edit_ifsc" class="form-control">
        		<label for="">MICR Code</label>
        		<input type="text" name="edit_micr" class="form-control">
        	</form>
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        	<button type="submit" name="update" id="update" class="btn btn-primary">Update</button>
        </div>
    </div>
</div>
</div>
</div>
	<!-- Script link for jquery -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			//Data Insert Code
			$('#submit').click(function(e){
				e.preventDefault();

				$.ajax({
					url:"{{url('addbank')}}",
					type:"post",
					dataType:"json",
					data:$('#bankform').serialize(),
					success: function(response){
						$('#bankform')[0].reset();
						console.log(response);
						table.ajax.reload();
					}
				});
			});
			//Data Display Code
			    var table = $("#bank").DataTable( {
				ajax: "{{url('getBank')}}",
				columns: [
				{ "data": "id" },
				{ "data": "bank_name" },
				{ "data": "ifsc_code" },
				{ "data": "micr_code" },
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
					url:"{{url('getBankById')}}",
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
						$('input[name="edit_name"]').val(response.data.bank_name);
						 $('input[name="edit_acc"]').val(response.data.account_no);
						$('input[name="edit_ifsc"]').val(response.data.ifsc_code);
						$('input[name="edit_micr"]').val(response.data.micr_code);

					}
				});
			})
    		//Update Code is here
    		$(document).on('click','#update',function(){
            if(confirm('Are you sure you want to update ??')){
                $.ajax({
                    url:'{{url("updatebank")}}',
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
                    url:'{{url("deleteBankById")}}',
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
		});
	</script>
</body>
</html>