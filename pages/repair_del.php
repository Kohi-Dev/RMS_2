<?php
include'../includes/connection.php';


                         
           

	if (!isset($_GET['do']) || $_GET['do'] != 1) {
						
    			$query = 'DELETE FROM repairs WHERE REPAIR_ID = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("JOB ORDER Successfully Deleted.");window.location = "customer.php";</script>					
            <?php
    			//break;
            }

?>