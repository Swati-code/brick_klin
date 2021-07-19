<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center mt-3">Product Details</h1>
		<div class="row mt-3">
			<div class="col-6 offset-3">
				<form>
					<div class="form-group">
						<label for="">Product Name:</label>
				        <input type="text" name="" class="form-control" placeholder="Enter product name">
					</div>
			        <div class="row">
						<div class="col">
							<label class="mr-sm-2">Product Code:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="Enter product code"name="">
						</div>
						<div class="col">
							<label class="mr-sm-2">Select Category:</label>
                             <select class="form-control"name="">
							    <option value=""></option>
						    </select>
                        </div>
					</div>
					<div class="row">
						<div class="col">
							<label class="mr-sm-2">Tax Id:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="">
						</div>
						<div class="col">
							<label class="mr-sm-2">HSN Id:</label>
                             <input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="" name="">
                        </div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Price</label>
							<input type="Number"class="form-control" id="" placeholder="">
						</div>
						<!-- <div class="col">
							<label for="">
								<textarea class="form-control"></textarea>
							</label>
						</div> -->
					</div>
					<div class="row">
						<div class="col">
							<label for="">Description:</label>
							<textarea col="10" row="2" class="form-control"></textarea>
						</div> 
					</div>
					<button type="submit" class="btn btn-success mt-3 w-100">Submit</button>
				</form>
			</div>
		</div>

	</div>

</body>
</html>