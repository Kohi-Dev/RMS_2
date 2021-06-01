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


$sql2 = "SELECT DISTINCT WARR_NAME, WARR_ID FROM warranty order by WARR_NAME asc";
$result = mysqli_query($db, $sql2) or die ("Bad SQL: $sql");

$warr = "<select class='form-control' name='warr' required'>
      //  <option disabled selected hidden>Select Warranty Status</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $warr .= "<option value='".$row['WARR_ID']."'>".$row['WARR_NAME']."</option>";
  }

$warr .= "</select>";

//repair stats
$sql1 = "SELECT DISTINCT STAT_NAME, STATUS_ID FROM status order by STATUS_ID asc";
$result = mysqli_query($db, $sql1) or die ("Bad SQL: $sql");

$stat = "<select class='form-control' name='status' required>
         <option disabled selected hidden>Select Repair Status</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $stat .= "<option value='".$row['STATUS_ID']."'>".$row['STAT_NAME']."</option>";
  }

$stat .= "</select>";
        ?>






<div class="card shadow mb-4 col-md-12">
  <div class="card-header py-3 bg-white">
    <h3 class="m-2 font-weight-bold text-primary">Job Order</h3>
          <h9><b>NOTE:</b> ANY UNCLAIMED AFTER SEVEN (7) DAYS UPON REPAIR WILL BE SUBJECT TO <b>STORAGE FEE </b>OF <b>70php per DAY UNCLAIMED UNITS AFTER FIFTEEN (15) DAYS SHALL BE FORFIETED.</b></h9>
  </div>
  <form role="form" method="post" action="repair_transac.php?action=add">
    <div align="right" style="margin-bottom:5px;">
      <label>Date Issued:</label>
      <?php 
        date_default_timezone_set("Asia/Hong_Kong"); 
        $today = date("Y-m-d h:i A"); 
        echo $today; 
      ?>
    </div>
    <legend><b>Client Info</b></legend>
    <hr>
    <div class="form-row">
      <div class="form-group col-md-3">
          <label><b>Job Order no.</b></label>
          <input class="form-control" placeholder="Job Order No." name="orderno" required>
      </div>
      <div class="form-group col-md-3" >
        <label>Assigned to:</label>
        <?php echo $emp;?>
      </div>
    </div>
    <div class="form row">
      <div class="form-group col-md-3">
        <label><b>Company Name:</b></label>
        <input class="form-control" placeholder="Company Name" name="comp">
      </div>
      <div class="form-group col-md-3">
        <label><b>Customer:</b></label>
        <div class="col-sm-12 text-primary btn-group">
          <?php echo $opt; ?>
          &nbsp;<a  href="#" data-toggle="modal" data-target="#customerModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a>
        </div>
      </div>
      <div class="form-group col-md-3">
        <label>Contact no</label>
        <input class="form-control" placeholder="Contact Number" type="number" name="contact">
      </div>
    </div>
    <legend><b>Item Info</b></legend>
    <hr>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label>Category</label>
        <?php echo $aaa;?>
      </div>
      <div class="form-group col-md-3">
        <label>Item Name</label>
        <input class="form-control" name="item_name" placeholder="Item Name" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label>Model</label>
        <input class="form-control" name="model" placeholder="Model" required>
      </div>
      <div class="form-group col-md-3">
        <label>IMEI/Serial no</label>
        <input class="form-control" name="serial_no" placeholder="IMEI/SN" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Item Condition</label>
        <textarea rows="5" cols="50" textarea class="form-control" placeholder="Describe the condition and defects" name="condition" required></textarea>
      </div>
      <div class="form-group col-md-6">
        <label>Accessories</label>
        <textarea rows="5" cols="50" textarea class="form-control" placeholder="Ex. Original box, Power cables" name="acc" required></textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label>Service Charges</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text">₱</span>
          </div>
            <input type="number" class="form-control text-right " name="serv">
        </div>
      </div>
      <div class="form-group col-md-3">
        <label>Parts</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text">₱</span>
          </div>
            <input type="number" class="form-control text-right " name="parts" >
        </div>
      </div>
      <div class="form-group col-md-3">
        <label>Advanced pay</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text">₱</span>
          </div>
            <input type="number" class="form-control text-right " name="adv_pay" required >
        </div>    
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        
      </div>
      
      
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label>Date diagnosed/fixed:</label>
        <input type="date" name="diag" class="form-control">
      </div>
      <div class="form-group col-md-3">
        <label>Warranty Status</label>
        <?php echo $warr;?>
      </div>
      <div class="form-group col-md-3">
        <label>Repair Status</label>
        <?php echo $stat;?>
      </div>
    </div>
      <div align="right" style="margin-bottom:5px;">
        <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
        <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
        <br>
        <br>
      </div> 
  </form>
</div>



<!-- Customer Modal pos-->
  <div class="modal fade" id="poscustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="cust_pos_trans.php?action=add">
            <div class="form-group">
              <label>First Name:</label>
              <input class="form-control" placeholder="First Name" name="firstname" required>
            </div>
            <div class="form-group">
              <label>Last Name:</label>
              <input class="form-control" placeholder="Last Name" name="lastname" required>
            </div>
            <div class="form-group">
                <label>Email Address:</label>
                <input class="form-control" placeholder="Email" name="email" required>
            </div>
            <div class="form-group">
              <label>Phone Number:</label>
              <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
            </div>
            <div class="form-group">
              <label>Address:</label>
              <input class="form-control" placeholder="Address" name="address" required>
            </div>
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>   
          </form>  
        </div>
      </div>
    </div>
  </div>



<?php
include'../includes/footer.php';
?>

