<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
  $query = 'SELECT ID, t.TYPE
            FROM users u
            JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['TYPE'];
                   
  if ($Aa=='User'){
?>
  <script type="text/javascript">
    //then it will be redirected
    alert("Restricted Page! You will be redirected to POS");
    window.location = "pos.php";
  </script>
<?php
  }
   
}
 $query = 'SELECT *
              FROM repairs r
              JOIN customer a ON r.`CUST_ID`=a.`CUST_ID`
              WHERE JOB_ORDER_NO ='.$_GET['id'];
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['REPAIR_ID'];
          $fname = $row['FIRST_NAME'];
          $lname = $row['LAST_NAME'];
          
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

          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="form-group row text-left mb0">
                <div class="col-sm-9">
                  <h5 class="font-weight-bold">JOB ORDER
                  </h5>
                </div>
                <div class="col-sm-3 py-1">
                  <h6>
                    Date: <?php echo $date; ?>
                  </h6>
                </div>
              </div>
<hr>
              <div class="form-group row text-left mb-0 py-2">
                <div class="col-sm-4 py-1">
                  <h6 class="font-weight-bold">
                    <?php echo $fname; ?> <?php echo $lname; ?>
                  </h6>
                  <h6>
                    Email: <?php echo $email;?>
                  </h6>
                  <h6>
                    Phone: <?php echo $pn; ?>
                  </h6>
                  <h6>
                    Contact: <?php echo $cont; ?>
                  </h6>
                </div>
                <div class="col-sm-4 py-1"></div>
                <div class="col-sm-4 py-1">
                  <h6>
                    Job Order# <?php echo $order_no; ?>
                  </h6>
                  <h6 class="font-weight-bold">

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

                    Assigned to: <?php echo $role; ?> <?php echo $efname; ?> <?php echo $elname; ?>
                  </h6>
                  <h6>
                    Date Diagnosed/Fixed: <?php echo $dia;?>
                  </h6>
                </div>
              </div>
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Item name</th>
                    <th>Problem/Condition</th>
                    <th>Warranty Status</th>
                    <th>Repair Status</th>
                  </tr>
                </thead>
                <tbody>
<?php  
           $query = 'SELECT *,c.CNAME, s.STAT_NAME
                     FROM repairs r 
                     join category c on r.`CATEGORY_ID`=c.`CATEGORY_ID`
                     join status s on r.`STATUS_ID`=s.`STATUS_ID`
                     join warranty w on r.`WARR_ID`=w.`WARR_ID`
                     WHERE JOB_ORDER_NO ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>'. $row['CNAME'].'</td>';
                echo '<td>'. $row['REP_ITEM'].'</td>';
                echo '<td>'. $row['COND'].'</td>';
                echo '<td>'. $row['WARR_NAME']. '</td>';
                echo '<td>'. $row['STAT_NAME'].'</td>';
                echo '</tr> ';
                        }
?>

                </tbody>
              </table>
                  <div class="form-group row text-left mb-0 py-2">
                    <div class="col-sm-4 py1"></div>
                    <div class="col-sm-3 py-1"></div>
                    <div class="col-sm-4 py-1">
                      <h4>
                        Advanced Pay: ₱ <?php echo number_format($adv_pay); ?>
                      </h4>
                      <table width="100%">
                        <tr>
                          <td class="font-weight-bold">Service Charge</td>
                          <td class="text-right">₱ <?php echo $serv; ?></td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">Parts Cost</td>
                          <td class="text-right">₱ <?php echo $parts; ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>

            </div>
          </div>


<?php
include'../includes/footer.php';
?>