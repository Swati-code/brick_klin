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
		<h1 class="text-center">Sales Invoice Product Details</h1>
		<a href="{{ url('/') }}" class="text-sm text-gray-700 underline">Back</a>
		<hr>
		<div class="row mt-3">
			<div class="col-6 offset-3">
				<form id="invoice">
					@csrf
					<div class="form-group">
						<label for="">Invoice Id:</label>
				        <input type="text" name="i_id" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="">Tax Id:</label>
				        <input type="text" name="tax_id" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="">Tax Rate:</label>
				        <input type="text" name="tax_rate" class="form-control" placeholder="">
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">CGST Amount:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder=""name="cgst">
						</div>
						 <div class="col">
						 	<label for="">SGST Amount:</label>
                             <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="sgst">
                         </div>
                        <div class="col">
							<label class="mr-sm-2">IGST Amount:</label>
                             <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="igst">
                        </div>
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">Quantity:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder=""name="quantity">
						</div>
						 <div class="col">
						 	<label for="">Product Price:</label>
                             <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="price">
                         </div>
                        
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">Total Amount:</label>
                             <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="total">
                        </div>
					</div>
					<button type="submit"  id="submit"class="btn btn-success mt-3 mb-3 w-100">Submit</button>
				</form>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col">
				<table id="invoice_details" class="table table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Invoice Id</th>
							<th>Quantity</th>
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
							  <label class="form-group" for="">Invoice Id:</label>
							<input type="text" name="edit_i_id" class="form-control">
							<label class="form-group" for="">Tax Id:</label>
							<input type="text" name="edit_tax_id" class="form-control">
							<label class="form-group" for="">Tax Rate:</label>
							<input type="text" name="edit_tax_rate" class="form-control">
							<label class="form-group" for="">CGST Amount:</label>
							<input type="text" name="edit_cgst" class="form-control">
							<label class="form-group" for="">SGST Amount:</label>
							<input type="text" name="edit_sgst" class="form-control">
							<label class="form-group" for="">IGST Amount:</label>
							<input type="text" name="edit_igst" class="form-control">
							<label class="form-group" for="">Quantity:</label>
							<input type="number" name="edit_quantity" class="form-control">
							<label class="form-group" for="">Price:</label>
							<input type="number" name="edit_price" class="form-control">
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
					url:"{{url('addinvoice')}}",
					type:"post",
					dataType:"json",
					data:$('#invoice').serialize(),
					success: function(response){
						$('#invoice')[0].reset();
						console.log(response);
						table.ajax.reload();
					}
				});
			});
    		//Data Display Code
			    var table = $("#invoice_details").DataTable( {
				ajax: "{{url('getinvoice')}}",
				columns: [
				{ "data": "id" },
				{ "data": "invoice_id" },
				{ "data": "quantity" },
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
					url:"{{url('getinvoiceById')}}",
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
						$('input[name="edit_i_id"]').val(response.data.invoice_id);
						$('input[name="edit_tax_id"]').val(response.data.tax_id);
						$('input[name="edit_tax_rate"]').val(response.data.tax_rate);
						$('input[name="edit_cgst"]').val(response.data.cgst_amount);
						$('input[name="edit_sgst"]').val(response.data.sgst_amount);
						$('input[name="edit_igst"]').val(response.data.igst_amount);
						$('input[name="edit_quantity"]').val(response.data.quantity);
						$('input[name="edit_price"]').val(response.data.price);
						$('input[name="edit_total"]').val(response.data.total_amount);
						
					}
				});
			})  
			//Update Code is here
    		$(document).on('click','#update',function(){
            if(confirm('Are you sure you want to update ??')){
                $.ajax({
                    url:'{{url("updateinvoice")}}',
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
                    url:'{{url("deleteinvoiceById")}}',
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