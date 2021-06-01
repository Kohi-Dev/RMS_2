<?php
include'../includes/connection.php';
?>

          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              
              $jo = $_POST['orderno'];
              $cust = $_POST['customer'];
              $cont = $_POST['contact'];
              $rep = $_POST['emp'];
              $comp = $_POST['comp'];
              $name =$_POST['item_name'];
              $cat = $_POST['category'];
              $ser = $_POST['serial_no'];
              $mod = $_POST['model'];
              $condis = $_POST['condition'];
              $acc = $_POST['acc'];
              $serv = $_POST['serv'];
              $parts = $_POST['parts'];
              $adv_pay = $_POST['adv_pay'];
              $warr = $_POST['warr'];
              $dia = $_POST['diag'];
              $stat = $_POST['status'];
               
              date_default_timezone_set("Asia/Hong_Kong"); 
              $today = date("Y-m-d h:i A"); 
        
      
        
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO repairs
                    (REPAIR_ID, JOB_ORDER_NO, COMP_NAME,
                    CUST_ID, CONTACT, REP_BY, REP_ITEM, MODEL, STATUS_ID, CATEGORY_ID, SERIAL_NO, DATE_ISSUED, DATE_DIAGNOSED, COND, ACCESSORIES, CHARGE, PARTS, ADV_PAY, WARR_ID)
                    VALUES (Null,'{$jo}','{$comp}','{$cust}','{$cont}','{$rep}','{$name}', '{$mod}','{$stat}','{$cat}','{$ser}', '{$today}','{$dia}', '{$condis}','{$acc}','{$serv}','{$parts}','{$adv_pay}','{$warr}')";
                    mysqli_query($db,$query)or die ('Error in updating Database. Check your records for avoing duplications');
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "repairs.php";
                window.location = "pos.php";
              </script>
          </div>

