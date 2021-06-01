<?php
include('../includes/connection.php');
			  $zz = $_POST['id'];
              $cust = $_POST['customer'];
              $cont = $_POST['contact'];
              $rep = $_POST['rep_by'];
              $comp = $_POST['comp'];
              $name =$_POST['item_name'];
              $cat = $_POST['category'];
              $ser = $_POST['serialno'];
              $mod = $_POST['model'];
              $condis = $_POST['condition'];
              $acc = $_POST['acc'];
              $serv = $_POST['serv'];
              $par = $_POST['part'];
              $adv_pay = $_POST['adv_pay'];
              $warr = $_POST['warr'];
              $diag = $_POST['diag'];
              $stat = $_POST['status'];
               
             // date_default_timezone_set("Asia/Hong_Kong"); 
             // $today = date("Y-m-d h:i A"); 

              $query = 'UPDATE repairs set 
	 				COMP_NAME="'.$comp.'", CONTACT="'.$cont.'", SERIAL_NO= "'.$ser.'" , REP_ITEM="'.$name.'", CATEGORY_ID ="'.$cat.'", MODEL="'.$mod.'",COND ="'.$condis.'", ACCESSORIES ="'.$acc.'", CHARGE = "'.$serv.'", PARTS ="'.$par.'", ADV_PAY ="'.$adv_pay.'", DATE_DIAGNOSED ="'.$diag.'", WARR_ID ="'.$warr.'", STATUS_ID="'.$stat.'", REP_BY="'.$rep.'"   WHERE
					REPAIR_ID="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));




?>
<script type="text/javascript">
   	alert("You've Update JOb Order Successfully.");
    window.location = "repairs.php";
    window.location = "rep.php";
</script>

