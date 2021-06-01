<?php
include('../includes/connection.php');
			$id = $_POST['id'];
			$b = $_POST['brand']; 
			$des = $_POST['descrip'];
	   	
		
	 			$query = 'UPDATE brand set BRAND_NAME ="'.$b.'", DESCRIP ="'.$des.'" WHERE
					BRAND_ID ="'.$id.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
			alert("You've Update Category Successfully.");
			window.location = "custom.php";
		</script>