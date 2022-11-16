<?php 
	include_once("header.php");
	if(isset($_POST['submit']))
	{
		include_once("DBConnect.php");
		$name = trim(stripslashes(strip_tags($_POST['name'])));
		$phone = trim(stripslashes(strip_tags($_POST['phone'])));	
		$email = trim(stripslashes(strip_tags($_POST['email'])));	
		$address = trim(stripslashes(strip_tags($_POST['message'])));
		$enquiry_dt = date("Y-m-d");			
	
		$res=mysqli_query($con, "insert into enquiry(name, phone, email, message, enquiry_dt) VALUES('$name', '$phone' , '$email', '$message', '$enquiry_dt')");									
		
		if($res)
		{
			echo "<script>alert('Enquiry Successfully Inserted');window.location='dashboard.php';</script>";
		}					
	}	
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="content-wrapper">
    <section class="content">
        <div class="container"> 
			<div class="row"> 
				<div class="col-md-11">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Add Enquiry</h3>
					</div>
					
					<div class="form-body">
						<div class="container">
							<form action="" method="post">
								
								<div class="row" style="margin-top:1%">	 
									<div class="col-md-4">
										<label for="exampleInputEmail1">Full Name</label> 
										<input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="" required> 
									</div> 
									<div class="col-md-3">
										<label for="exampleInputPassword1">Mobile Number</label> 
										<input type="text" class="form-control" name="phone" id="phone" placeholder="Mobile Number" value="" required maxlength="10" minlength="10" onkeypress="return isNumber(event)"> 
									</div> 
									<div class="col-md-3">
										<label for="exampleInputPassword1">Email ID</label> 
										<input type="email" class="form-control" name="email" id="email" placeholder="Email ID" value=""> 
									</div>									
								</div>
																
								<div class="row" style="margin-top:1%">									
									<div class="col-md-10">
										<label for="exampleInputPassword1">Message</label> 
										<textarea class="form-control" name="message" id="message" placeholder="Message" value=""> </textarea>
									</div>				
								</div>							
								
								<div class="row" style="margin-top:3%">	
									<div class="col-md-5"><a href="dashboard.php" class="btn btn-default">Back</a></div>
									<div class="col-md-4"></div>
									<div class="col-md-1">
										<button type="submit" name="submit" class="btn btn-success">Submit</button> 
									</div>
								</div>
							</form> 
							
							<br>
							<br>
						</div>
						</div>
				</div>
				</div>
			</div>
		  
		
        </div>       
    </section>	
</div>
	
	
 <script>
		function isNumber(evt) 
		{
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
	</script>
	<?php $include_once("footer.php"); ?>
	


<script>
  $.validate({
    lang: 'en'
  });
</script>