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

$cust = "<select class='form-control'  style='border-radius: 0px;' name='customer' required>
        <option value='' disabled selected hidden>Select Customer</option>";
  while ($row = mysqli_fetch_assoc($res)) {
    $cust .= "<option value='".$row['CUST_ID']."'>".$row['FIRST_NAME'].' '.$row['LAST_NAME']."</option>";
  }
$cust .= "</select>";
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

            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Repair Order</h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>

                   <tr>
                     <th>Job order</th>
                     <th>Customer</th>
                     <th>Item Name</th>
                     <th>Category</th>
                     <th width="13%">Repair Status</th>
                     <th width="11%">Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT *, JOB_ORDER_NO, FIRST_NAME, LAST_NAME, REP_ITEM, STAT_NAME FROM repairs r 
    join category c on r.CATEGORY_ID=c.CATEGORY_ID 
    JOIN customer a ON r.`CUST_ID`=a.`CUST_ID`
    join status s on r.`STATUS_ID`=s.`STATUS_ID`
    ';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['JOB_ORDER_NO'].'</td>';
                echo '<td>'. $row['FIRST_NAME'].' '. $row['LAST_NAME'].'</td>';
                echo '<td>'. $row['REP_ITEM'].'</td>';
                echo '<td>'. $row['CNAME'].'</td>';
                echo '<td>'. $row['STAT_NAME'].'</td>';
                
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="rep_view.php?action=edit & id='.$row['JOB_ORDER_NO'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="rep_edit.php?action=edit & id='.$row['JOB_ORDER_NO']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                  
                                </li>
                            </ul>
                            </div>
                          </div> </td>';
                echo '</tr> ';
                        }
?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

 

<?php
?>

<?php
include'../includes/footer.php';
?> 







