<?php
	session_start();	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	include_once("DBConnect.php");
	
	if(isset($_GET['enquiry_id']))
	{
		$enquiry_id = $_GET['enquiry_id'];
		$res = mysqli_query($con, "DELETE FROM enquiry where enquiry_id = '$enquiry_id'");
		if($res)
		{
			echo "<script>alert('Successfully Deleted');window.location='dashboard.php';</script>";
		}
	}
	
?>