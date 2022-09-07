<?php 
	include_once("header.php");
	$enquiry_id = trim(stripslashes(strip_tags($_GET['enquiry_id'])));
	if(isset($_POST['submit']))
	{
		include_once("DBConnect.php");
		$name = trim(stripslashes(strip_tags($_POST['name'])));
		$phone = trim(stripslashes(strip_tags($_POST['phone'])));	
		$email = trim(stripslashes(strip_tags($_POST['email'])));	
		$message = trim(stripslashes(strip_tags($_POST['message'])));
		$enquiry_dt = date("Y-m-d");			
	
		$res=mysqli_query($con,"UPDATE enquiry SET name='$name', phone='$phone', email='$email', message='$message'  WHERE enquiry_id='$enquiry_id'");
		if($res)
		{
			echo "<script>alert('Enquiry updated Inserted');window.location='dashboard.php';</script>";
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
								<?php			
									include_once('DBConnect.php');
									$res=mysqli_query($con,"SELECT * FROM enquiry where enquiry_id='$enquiry_id'");
									if(mysqli_num_rows($res)>0)
									{
										while($row=mysqli_fetch_array($res))
										{						
								?>	
								<div class="row" style="margin-top:1%">	 
									<div class="col-md-4">
										<label for="exampleInputEmail1">Full Name</label> 
										<input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="<?php echo $row['name'];?>" required> 
									</div> 
									<div class="col-md-3">
										<label for="exampleInputPassword1">Mobile Number</label> 
										<input type="text" class="form-control" name="phone" id="phone" placeholder="Mobile Number" value="<?php echo $row['phone'];?>" required maxlength="10" minlength="10" onkeypress="return isNumber(event)"> 
									</div> 
									<div class="col-md-3">
										<label for="exampleInputPassword1">Email ID</label> 
										<input type="email" class="form-control" name="email" id="email" placeholder="Email ID" value="<?php echo $row['email'];?>"> 
									</div>									
								</div>
																
								<div class="row" style="margin-top:1%">									
									<div class="col-md-10">
										<label for="exampleInputPassword1">Message</label> 
										<textarea class="form-control" name="message" id="message" placeholder="Message" value=""><?php echo $row['message'];?> </textarea>
									</div>				
								</div>							
								
								<div class="row" style="margin-top:3%">	
									<div class="col-md-5"><a href="dashboard.php" class="btn btn-default">Back</a></div>
									<div class="col-md-4"></div>
									<div class="col-md-1">
										<button type="submit" name="submit" class="btn btn-success">Update</button> 
									</div>
								</div>
								
								<?php
										}
									}		
								?>
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