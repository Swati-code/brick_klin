<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center mt-3">Company Details</h1>
		<hr>
		<div class="row mt-3">
			<div class="col-6 offset-3">
				<form id="companyform">
					@csrf
					<div class="form-group">
						<label for="">Company Name:</label>
						<input type="text" name="company_name" class="form-control" placeholder="Enter company name">
					</div>
					<div class="form-group">
						<label for="">Address:</label>
						<input type="text" name="address" class="form-control" placeholder="Enter address">
					</div>
					<div class="form-group">
						<label for="">Contact Number:</label>
						<input type="Number" name="phone_no" class="form-control" placeholder="Enter phone number">
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">PAN Number:</label>
							<input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter PAN number"name="pan_no">
						</div>
						<div class="col">
							<label class="mr-sm-2">VAT Number:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter VAT number" name="vat_no">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">GST Number:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter GST number"name="gst_no">
						</div>
						<div class="col">
							<label class="mr-sm-2">State Code:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter state code" name="state">
						</div>
					</div>

					<button type="submit" id="submit"class="btn btn-success mt-3 w-100">Submit</button>
				</form>

			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col">
				<table id="company" class="table table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Bank Name</th>
							<th>Address</th>
							<th>State Code</th>
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
						<h5 class="modal-title" id="exampleModalLabel">Update City</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="updateform">
							{{csrf_field()}}
                            <!-- hidden id input field -->
                            <input type="text" name="id">
							<label for="">Company Name</label>
							<input type="text" name="edit_name" required="" class="form-control">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="edit_address">
                            </div>
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" name="edit_phno">
                            <label for="">State Code</label>
                            <input type="text" class="form-control" name="edit_statecode">
                            <label for="">PAN Number</label>
                            <input type="text" class="form-control" name="edit_panno">
                            <label for="">VAT Number</label>
                            <input type="text" class="form-control" name="edit_vatno">
                            <label for="">GST Number</label>
                            <input type="text" class="form-control" name="edit_gstno">
                        </form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" id="update" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
        </div>
	</div>
	
    <!-- Script link for jquery -->

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script  src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			//Data Insert Code
			$(document).on('click','#submit',function(e){
				e.preventDefault();
				 $.ajax({
				 	url:"{{url('addcompany')}}",
				 	type:"post",
				 	dataType:"json",
				 	data:$('#companyform').serialize(),
				 	success:function(response){
				 		$('#companyform')[0].reset();
              		    console.log(response);
              		    table.ajax.reload();
	
				 	}
				 })
			})
			//Data Display Code

            var table = $('#company').DataTable( {
            	ajax: "{{url('getCompany')}}",
            	columns: [
            	{ "data": "id"},
            	{ "data": "name" },
            	{ "data": "address" },
            	{ "data": "state_code"},
            	{ 
            		"data": null,
            		render:function(data,row,type){
            			return `<button  class="btn btn-info" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit"  type="submit"><i class="fa fa-edit"></i></button>`;
            		}

            	},
            	{ 
            		"data": null,
                        render: function(data, type, row) {
                            return `<button data-id="${data.id}" class="btn btn-danger" id="delete" type="submit"><i class="fa fa-trash"></button>`;
                        } 
                    }
            
            	]
            } );
            //edit code is here
			$(document).on('click','#edit',function(){
				$.ajax({
					url:"{{url('getCompanyById')}}",
					type:"post",
					dataType:"json",
					data:{
                        "_token":"{{ csrf_token() }}",
                        "id":$(this).data('id'),
                    },
					success:function(response){
						//console.log(response);
						// console.log(response.data.account_no);
						$('input[name="id"]').val(response.data.id);
						$('input[name="edit_name"]').val(response.data.name);
						$('input[name="edit_address"]').val(response.data.address);
						$('input[name="edit_phno"]').val(response.data.phone_no);
						$('input[name="edit_statecode"]').val(response.data.state_code);
						$('input[name="edit_vatno"]').val(response.data.vat_no);
						$('input[name="edit_panno"]').val(response.data.pan_no);
						$('input[name="edit_gstno"]').val(response.data.gst_no);

					}
				});
			})
			$(document).on('click','#update',function(){
            if(confirm('Are you sure you want to update ??')){
                $.ajax({
                    url:'{{url("updatecompany")}}',
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
                    url:'{{url("deleteCompanyById")}}',
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
