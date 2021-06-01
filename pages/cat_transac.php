<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

            ?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $zz = $_POST['id'];
              $c = $_POST['category'];
              $d = $_POST['descrip'];

              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO category
                    (CATEGORY_ID, CNAME, DESCRIP)
                    VALUES (Null,'{$c}', '{$d}')";
                    mysqli_query($db,$query)or die ('Error in updating Database');
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "custom.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>