<?php
include'../includes/connection.php';
include'../includes/topp.php';
  
?>

<?php
 //DROPDOWN FOR CUSTOMER
$sql = "SELECT CUST_ID, FIRST_NAME, LAST_NAME
        FROM customer
        order by FIRST_NAME asc";
$res = mysqli_query($db, $sql) or die ("Error SQL: $sql");

$opt = "<select class='form-control'  style='border-radius: 0px;' name='customer' required>
        <option value='' disabled selected hidden>Select Customer</option>";
  while ($row = mysqli_fetch_assoc($res)) {
    $opt .= "<option value='".$row['CUST_ID']."'>".$row['FIRST_NAME'].' '.$row['LAST_NAME']."</option>";
  }
$opt .= "</select>";
// END OF DROP DOWN

$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$aaa = "<select class='form-control' name='category' required' id='category'>
      //  <option disabled selected hidden>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $aaa .= "<option value='".$row['CATEGORY_ID']."'>".$row['CNAME']."</option>";
  }

$aaa .= "</select>";

//employee
$sql = "SELECT EMPLOYEE_ID, FIRST_NAME, LAST_NAME, j.JOB_TITLE
        FROM employee e
        JOIN job j ON j.JOB_ID=e.JOB_ID
        order by e.LAST_NAME asc";
$res = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$emp = "<select class='form-control' name='emp' required>
        <option value='' disabled selected hidden>Select Employee</option>";
  while ($row = mysqli_fetch_assoc($res)) {
    $emp .= "<option value='".$row['EMPLOYEE_ID']."'>".$row['LAST_NAME'].', '.$row['FIRST_NAME'].' - '.$row['JOB_TITLE']."</option>";
  }
$emp .= "</select>";

$sql = "SELECT EMPLOYEE_ID, FIRST_NAME, LAST_NAME, j.JOB_TITLE
        FROM employee e
        JOIN job j ON j.JOB_ID=e.JOB_ID
        order by e.LAST_NAME asc";
$res = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$ops = "<select class='form-control' name='ops' required>
        <option value='' disabled selected hidden>Select Employee</option>";
  while ($row = mysqli_fetch_assoc($res)) {
    $ops .= "<option value='".$row['EMPLOYEE_ID']."'>".$row['LAST_NAME'].', '.$row['FIRST_NAME'].' - '.$row['JOB_TITLE']."</option>";
  }
$ops .= "</select>";

$sql2 = "SELECT DISTINCT WARR_NAME, WARR_ID FROM warranty order by WARR_NAME asc";
$result = mysqli_query($db, $sql2) or die ("Bad SQL: $sql");

$war = "<select class='form-control' name='warr' required'>
      //  <option disabled selected hidden>Select Warranty Status</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $war .= "<option value='".$row['WARR_ID']."'>".$row['WARR_NAME']."</option>";
  }

$war .= "</select>";

//repair stats
$sql1 = "SELECT DISTINCT STAT_NAME, STATUS_ID FROM status order by STATUS_ID asc";
$result = mysqli_query($db, $sql1) or die ("Bad SQL: $sql");

$stats = "<select class='form-control' name='status' required>
         <option disabled selected hidden>Select Repair Status</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $stats .= "<option value='".$row['STATUS_ID']."'>".$row['STAT_NAME']."</option>";
  }

$stats .= "</select>";
        ?>
<?php

		$query = 'SELECT *
              FROM repairs r
              JOIN customer a ON r.`CUST_ID`=a.`CUST_ID`
              WHERE JOB_ORDER_NO ='.$_GET['id'];
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['REPAIR_ID'];
          $fname = $row['FIRST_NAME'];
          $lname = $row['LAST_NAME'];
          $comp = $row['COMP_NAME'];
          $pn = $row['PHONE_NUMBER'];
          $cont = $row['CONTACT'];
          $email = $row['EMAIL'];
          $home = $row['ADDRESS'];
          $order_no = $row['JOB_ORDER_NO'];
          $date = $row['DATE_ISSUED'];
          $dia =$row['DATE_DIAGNOSED'];
          $rep_by = $row['REP_BY'];
          $serv = $row['CHARGE'];
          $parts = $row['PARTS'];
          $adv_pay = $row['ADV_PAY'];
        }

?>

<?php  
           $query = 'SELECT *,c.CNAME, s.STAT_NAME
                     FROM repairs r 
                     join category c on r.`CATEGORY_ID`=c.`CATEGORY_ID`
                     join status s on r.`STATUS_ID`=s.`STATUS_ID`
                     join warranty w on r.`WARR_ID`=w.`WARR_ID`
                     WHERE JOB_ORDER_NO ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {

            	$item = $row['REP_ITEM'];
            	$serial = $row['SERIAL_NO'];
            	$cond = $row['COND'];
            	$mod = $row['MODEL'];
            	$cat = $row['CNAME'];
            	$acc = $row['ACCESSORIES'];
            	$warr = $row['WARR_NAME'];
            	$stat = $row['STAT_NAME'];
                        }
?>

<?php
                   $query = 'SELECT *
                            FROM repairs r
                            join employee e on r.`REP_BY`=e.`EMPLOYEE_ID`
                            join job j on e.`JOB_ID`=j.`JOB_ID`
                            WHERE JOB_ORDER_NO ='.$_GET['id'];
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_assoc($result)) {
                              $efname = $row['FIRST_NAME'];
                              $elname = $row['LAST_NAME'];
                              $role = $row['JOB_TITLE'];

                            }

?>

 <center>
 	<div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
 		<div class="card-header py-3">
            <h4 class="m-2 font-weight-bold text-primary">Update Job Order</h4>
        </div>
        <a href="rep.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
        <div class="card-body">
        	<form role="form" method="post" action="repair_edit1.php">
        		<input type="hidden" name="id" value="<?php echo $id; ?>" />
        		<div class="form-group row text-left text-warning">
                	<div class="col-sm-3" style="padding-top: 5px;">
                 		Job Order:
                	</div>
                	<div class="col-sm-9">
                  		<input class="form-control" placeholder="orderno" name="prodcode" value="<?php echo $order_no; ?>" readonly>
               		</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Company Name:
               		</div>
                	<div class="col-sm-9">
                  		<input class="form-control" placeholder="comp" name="comp" value="<?php echo $comp; ?>">
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Customer:
               		</div>
               		<div class="col-sm-9">
                  		<input class="form-control" placeholder="customer" name="customer" value="<?php echo $fname; ?> <?php echo $lname;?>" readonly>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Contact:
               		</div>
               		<div class="col-sm-9">
                  		<input class="form-control" placeholder="contact" type="number" name="contact" value="<?php echo $cont; ?>" required>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Item name:
               		</div>
               		<div class="col-sm-9">
                  		<input class="form-control" placeholder="item name" name="item_name" value="<?php echo $item; ?>" required>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Category:
               		</div>
               		<div class="col-sm-4">
                  		<input class="form-control" placeholder="Category" name="category" value="<?php echo $cat; ?>" readonly>
                	</div>
               		<div class="col-sm-4">
                  		<?php 
                  			echo $aaa;
                  		?>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Model:
               		</div>
               		<div class="col-sm-9">
                  		<input class="form-control" placeholder="model" name="model" value="<?php echo $mod; ?>" required>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Condition:
               		</div>
               		<div class="col-sm-9">
                  		<input  class="form-control" placeholder="condition" name="condition" value="<?php echo $cond; ?>" required>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Accessories:
               		</div>
               		<div class="col-sm-9">
                  		<input  class="form-control" placeholder="Accessories" name="acc" value="<?php echo $acc; ?>" required>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Service Charge in ₱:
               		</div>
               		<div class="col-sm-9">
                  		<input type="number" class="form-control" placeholder="Service pay" name="serv" value="<?php echo $serv; ?>" required>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Parts Cost in ₱:
               		</div>
               		<div class="col-sm-9">
                  		<input type="number" class="form-control" placeholder="Parts Cost" name="serv" value="<?php echo $parts; ?>" required>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Advance Pay in ₱:
               		</div>
               		<div class="col-sm-9">
                  		<input type="number" class="form-control" placeholder="Advance Pay" name="adv_pay" value="<?php echo $adv_pay; ?>" required>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Date Diagnosed/ Fixed:
               		</div>
               		<div class="col-sm-9">
                  		<input type="date" class="form-control" placeholder="Parts Cost" name="serv" value="<?php echo $dia; ?>" required>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Warranty Status:
               		</div>
               		<div class="col-sm-4">
                  		<input class="form-control" placeholder="Parts Cost" name="warr" value="<?php echo $warr; ?>" readonly>
                  		
                	</div>
                	<div class="col-sm-4">
                		<?php echo $war;?>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Repair Status:
               		</div>
               		<div class="col-sm-4">
                  		<input class="form-control" placeholder="Parts Cost" name="status" value="<?php echo $stat; ?>" readonly>
                  		
                	</div>
                	<div class="col-sm-4">
                		<?php echo $stats;?>
                	</div>
              	</div>
              	<div class="form-group row text-left text-warning">
              		<div class="col-sm-3" style="padding-top: 5px;">
                 		Assigned to:
               		</div>
               		<div class="col-sm-4">
                  		<input class="form-control" placeholder="Parts Cost" name="rep_by" value="<?php echo $efname; ?><?php echo $elname?> - <?php echo $role;?>" readonly>
                	</div>
                	<div class="col-sm-4">
                		<?php echo $emp;?>
                	</div>
              	</div>
              	<hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button>

        	</form>
        </div>
 	</div>
 </center>