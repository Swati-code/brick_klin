<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center">Sales Invoice Product Details</h1>
		<div class="row mt-3">
			<div class="col-6 offset-3">
				<form>
					<div class="form-group">
						<label for="">Invoice Id:</label>
				        <input type="text" name="" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="">Tax Id:</label>
				        <input type="text" name="" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="">Tax Rate:</label>
				        <input type="text" name="" class="form-control" placeholder="">
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">CGST Amount:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder=""name="">
						</div>
						 <div class="col">
						 	<label for="">SGST Amount:</label>
                             <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="">
                         </div>
                        <div class="col">
							<label class="mr-sm-2">IGST Amount:</label>
                             <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="">
                        </div>
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">Quantity:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder=""name="">
						</div>
						 <div class="col">
						 	<label for="">Product Price:</label>
                             <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="">
                         </div>
                        
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">Total Amount:</label>
                             <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="">
                        </div>
					</div>
					<button type="submit" class="btn btn-success mt-3 w-100">Submit</button>
				</form>
			</div>
		</div>

	</div>
</body>
</html>