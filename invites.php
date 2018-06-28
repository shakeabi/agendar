<?php
  include_once('config.php');
  include_once('functions.php');
  session_start();
  if(!isset($_SESSION['curr_id'])){header("Location: index.php");}
  $flag=0;
 ?>

<?php include_once('includes/header.php') ?>

    <!-- Navigation -->
<?php include_once('includes/navigation.php') ?>

    <!-- Content -->
    <div class="container">

        <div class="row">


            <div class="col-md-12">

                <h1 class="page-header">
                    <?php echo "{$_SESSION['curr_user']}'s Invites" ?>
                </h1>
                <div class="" id="torefresh">
                  <?php
                    $table = $_SESSION['curr_user'].'invites';

                    $query = "SELECT * FROM $table ORDER BY createTime DESC ";
                    $result = $connection->query($query);
                    confirmQuery($result);
                    while($row = $result->fetch_assoc()){
                      $flag = 1;
                      $inv_id     = $row['id'];
                      $inv_u_id     = $row['userId'];
                      $inv_u_name     = $row['userName'];
                      $inv_e_id     = $row['eventId'];

                      $table_temp = $inv_u_id."events";
                      $query_temp = "SELECT * FROM $table_temp WHERE id = $inv_e_id";
                      $result_temp = $connection->query($query_temp);
                      confirmQuery($result_temp);
                      $row_temp = $result_temp->fetch_assoc();

                      $inv_e_title = $row_temp['title'];
                      $inv_e_desc = $row_temp['description'];
                      $inv_e_sTime = $row_temp['startTime'];
                      $inv_e_eTime = $row_temp['endTime'];
                      $inv_e_date = $row_temp['eDate'];
                  ?>
                      <!-- Note -->
                      <h2>
                          <?php echo $inv_e_title; ?><small><?php echo " Invited by: " .$inv_u_name; ?></small>
                      </h2>
                      <br>
                      <p><span class="glyphicon glyphicon-time"></span> From <?php echo $inv_e_sTime." "; ?><span class="glyphicon glyphicon-time"></span> To <?php echo $inv_e_eTime." "; ?><span class="glyphicon glyphicon-calendar"></span><?php echo $inv_e_date; ?></p>
                      <hr>
                      <p><?php echo $inv_e_desc; ?></p>
                      <p>
                        <button class="btn btn-primary" onclick="window.location='invitationStatus.php?uId=<?php echo $inv_u_id;?>&eId=<?php echo $inv_e_id;?>&invId=<?php echo $inv_id; ?>&status=1';">Accept</button><button class="btn btn-primary" style="margin-left:1%;" onclick="window.location='invitationStatus.php?uId=<?php echo $inv_u_id;?>&eId=<?php echo $inv_e_id;?>&invId=<?php echo $inv_id; ?>&status=0';">Decline</button>
                      </p>
                      <hr style="border-width:5px; ">
                  <?php
                    }

                    if(!$flag){
                      echo "<h2>Nothing to display!</h2>";
                    }

                  ?>


                </div>

            </div>
          </div>
        <hr>

        <!-- Footer -->
<?php include_once('includes/footer_i.php') ?>
