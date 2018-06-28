<?php
session_start();
include_once('config.php');
include_once('functions.php');
if(!isset($_SESSION['curr_id'])){redirect("index.php");}

date_default_timezone_set('Asia/Kolkata');
$flag=0;

if(!isset($_GET['date'])){
  $disp_date = date("Y-m-d");
  $temparr = explode("-",$disp_date);
  $d = mktime(0,0,0,$temparr[1],$temparr[2],$temparr[0]);
  $disp_date_nice = date("D d, M, Y",$d);
}
else{
  $disp_date = $_GET['date'];
  $temparr = explode("-",$disp_date);
  $d = mktime(0,0,0,$temparr[1],$temparr[2],$temparr[0]);
  $disp_date_nice = date("D d, M, Y",$d);
}

 ?>

<?php include_once('includes/header.php') ?>

    <!-- Navigation -->
<?php include_once('includes/navigation.php') ?>

    <!-- Content -->
    <div class="container">


        <div class="row">

            <!-- Task Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo "{$_SESSION['curr_user']}'s Appointments:";?><small> <?php echo $disp_date_nice; ?></small>
                    <div>
                      <button class="btn btn-primary" onclick="window.location='add_event.php?date=<?php echo $disp_date;?>'">Add Event</button>
                    </div>
                </h1>
<!-- //////////////////////////////////////////////////////////////////////// -->
                <?php
                  $table = $_SESSION['curr_id'].'events';

                  $query = "SELECT * FROM $table WHERE eDate = '{$disp_date}'  ORDER BY createTime DESC ";
                  $result = $connection->query($query);
                  confirmQuery($result);
                  while($row = $result->fetch_assoc()){
                    $flag = 1;
                    $note_id     = $row['id'];
                    $note_title     = $row['title'];
                    $note_content   = $row['description'];
                    $note_start  = $row['startTime'];
                    $note_end     = $row['endTime'];
                    $inviter = $row['invited'];
                ?>
                    <!-- Note -->
                    <h2>
                        <?php echo $note_title; ?>
                    </h2>
                    <br>
                      <?php if($inviter != "") echo "<p>
                      Invited By: {$inviter}
                      </p>" ?>
                    <p><span class="glyphicon glyphicon-time"></span> From <?php echo $note_start." "; ?><span class="glyphicon glyphicon-time"></span> To <?php echo $note_end; ?></p>
                    <hr>
                    <p><?php echo $note_content; ?></p>

                    <hr style="border-width:5px; ">
                <?php
                  }

                  if(!$flag){
                    echo "<h2>Nothing to display!</h2>";
                  }

                ?>
<!-- //////////////////////////////////////////////////////////////////////// -->

            </div>


            <!-- Sidebar -->
<?php include_once('includes/sidebar.php') ?>

        <!-- Footer -->
<?php include_once('includes/footer.php') ?>
