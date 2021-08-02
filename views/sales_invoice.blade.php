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
		<h1 class="text-center">Sales Invoice Details</h1>
		<a href="{{ url('/') }}" class="text-sm text-gray-700 underline">Back</a>
		<hr>
		<div class="row mt-3">
			<div class="col-6 offset-3">
				<form id="sales">
					@csrf
					<div class="row">
						<div class="col">
							<label class="form-group" for="">Customer Id:</label>
							<input type="text" name="c_id" class="form-control">
						</div>
						<div class="col">
							<label class="form-group" for="">Vehicle Number:</label>
							<input type="text" name="vehicle_no" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label class="form-group" for="">Invoice Number:</label>
							<input type="text" name="invoice" class="form-control">
						</div>
						<div class="col">
							<label class="form-group" for="">Invoice Date:</label>
							<input type="Date" name="inv_date" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label class="form-group" for="">Amount before Tax:</label>
							<input type="text" name="amtbefore" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label class="form-group" for="">CGST Amount:</label>
							<input type="text" name="cgst" class="form-control">
						</div>
						<div class="col">
							<label class="form-group" for="">SGST Amount:</label>
							<input type="text" name="sgst" class="form-control">
						</div>
						<div class="col">
							<label class="form-group" for="">ISGST Amount:</label>
							<input type="text" name="igst" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label class="form-group" for="">Amount after Tax:</label>
							<input type="text" name="amtafter" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label class="form-group" for="">CGCR:</label>
							<input type="number" name="cgcr" class="form-control">
						</div>
						<div class="col">
							<label class="form-group" for="">Freight Tax:</label>
							<input type="number" name="freight" class="form-control">
						</div>
						<div class="col">
							<label class="form-group" for="">Labour Tax:</label>
							<input type="number" name="labour" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label class="form-group" for="">Total Amount:</label>
							<input type="Number" name="total" class="form-control">
						</div>
					</div>
					<button type="submit" id="submit" class="btn btn-success mt-3 mb-4 w-100">Submit</button>
				</form>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col">
				<table id="invoice" class="table table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Customer Id</th>
							<th>Invoice Number</th>
							<th>Total Amount</th>
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
							  <label class="form-group" for="">Customer Id:</label>
							<input type="text" name="edit_c_id" class="form-control">
							<label class="form-group" for="">Vehicle Number:</label>
							<input type="text" name="edit_vehicle_no" class="form-control">
							<label class="form-group" for="">Invoice Number:</label>
							<input type="text" name="edit_invoice" class="form-control">
							<label class="form-group" for="">Invoice Date:</label>
							<input type="Date" name="edit_inv_date" class="form-control">
							<label class="form-group" for="">Amount before Tax:</label>
							<input type="text" name="edit_amtbefore" class="form-control">
							<label class="form-group" for="">Amount after Tax:</label>
							<input type="text" name="edit_amtafter" class="form-control">
							<label class="form-group" for="">CGCR:</label>
							<input type="text" name="edit_cgcr" class="form-control">
							<label class="form-group" for="">Freight Tax:</label>
							<input type="number" name="edit_freight" class="form-control">
							<label class="form-group" for="">Labour Tax:</label>
							<input type="number" name="edit_labour" class="form-control">
							<label class="form-group" for="">Total Amount:</label>
							<input type="Number" name="edit_total" class="form-control">
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
    <script >
    	$(document).ready(function() {
    		$('#submit').click(function(e){
    			//Insert Code 
				e.preventDefault();

				$.ajax({
					url:"{{url('addsales')}}",
					type:"post",
					dataType:"json",
					data:$('#sales').serialize(),
					success: function(response){
						$('#sales')[0].reset();
						console.log(response);
						table.ajax.reload();
					}
				});
			});
    		//Data Display Code
			    var table = $("#invoice").DataTable( {
				ajax: "{{url('getsales')}}",
				columns: [
				{ "data": "id" },
				{ "data": "customer_id" },
				{ "data": "invoice_number" },
				{ "data": "total_amount" },
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
					url:"{{url('getsalesById')}}",
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
						$('input[name="edit_c_id"]').val(response.data.customer_id);
						$('input[name="edit_vehicle_no"]').val(response.data.vehicle_no);
						$('input[name="edit_invoice"]').val(response.data.invoice_number);
						$('input[name="edit_inv_date"]').val(response.data.invoice_date);
						$('input[name="edit_amtbefore"]').val(response.data.amount_before_tax);
						$('input[name="edit_amtafter"]').val(response.data.amount_after_tax);
						$('input[name="edit_cgcr"]').val(response.data.cgcr);
						$('input[name="edit_freight"]').val(response.data.freight);
						$('input[name="edit_labour"]').val(response.data.labour_tax);
						$('input[name="edit_total"]').val(response.data.total_amount);
						
					}
				});
			})  
			//Update Code is here
    		$(document).on('click','#update',function(){
            if(confirm('Are you sure you want to update ??')){
                $.ajax({
                    url:'{{url("updatesales")}}',
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
                    url:'{{url("deletesalesById")}}',
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