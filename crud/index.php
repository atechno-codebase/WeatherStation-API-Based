	<?php
		
		if(isset($_POST['login']))
		{
			$uid=trim(stripslashes(strip_tags($_POST['username'])));
			$pwd=trim(stripslashes(strip_tags($_POST['password'])));
			include_once('DBConnect.php');
			$res=mysqli_query($con,"select * from user where username='$uid' AND password='$pwd'");
			if(mysqli_num_rows($res)>0)
			{		
				session_start();
				$_SESSION['username']=$uid;
				echo "<script>window.location='dashboard.php';</script>";
			}
			else
			{
				$emsg="<b style='color:red;margin-top:10%'>Sorry! Incorrect Username / Password!</b>";
				
			}
		}	
	?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Atechno Solutions, Pune</title>
      <!-- Meta tags -->
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="keywords" content=""
         />
      <script>
         addEventListener("load", function () { setTimeout(hideURLbar, 0); }, false); function hideURLbar() { window.scrollTo(0, 1); }
      </script>
      <!-- Meta tags -->
      <!--stylesheets-->
      <link href="assets/login/css/style1.css" rel='stylesheet' type='text/css' media="all">
      <!--//style sheet end here-->
      <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   </head>
   <body>
		
      <div class="mid-class">
         <div class="art-right-grids">
            <h2>Sign In </h2>
			<?php
				if(isset($emsg))
					{
						echo "<center style='padding-top:2%'>".$emsg;
					}
			?>
            <form action="" method="post">
               <div class="main">
                  <div class="form-left-to-mids">
                     <input type="text" name="username" placeholder="User Id" required="">
                  </div>
                  <div class="form-left-to-mids ">
                     <input type="password" name="password" placeholder="Password" required="">
                     <div class="clear"></div>
                  </div>
               </div>
            
               <div class="btnn">
                  <button type="submit" name="login">Sign In</button>
               </div>
            </form>
            
            
		
			
         </div>
         
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
	
      <footer class="bottem-tree-footer">
         <p>
            © 2022 Atechno Solutions. All Rights Reserved.
         </p>
      </footer>
   </body>
</html>