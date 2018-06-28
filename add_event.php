<?php
session_start();
include_once('config.php');
include_once('functions.php');
if(!isset($_SESSION['curr_id'])){header("Location: index.php");}

date_default_timezone_set('Asia/Kolkata');

   if(isset($_POST['create_event'])) {

            $event_title        = $connection->real_escape_string($_POST['title']);
            $event_desc         = $connection->real_escape_string($_POST['description']);

            if(isset($_POST['invitees']))
            $event_inv          = $connection->real_escape_string($_POST['invitees']);
            else {
              $event_inv = "";
            }
            $start_time         = $connection->real_escape_string($_POST['start_time']);
            $end_time           = $connection->real_escape_string($_POST['end_time']);

            $event_time         = date("l jS \of F Y h:i:s A");
            if(isset($_GET['date']))
            $event_date         = $_GET['date'];

          $table = $_SESSION['curr_id']."events";

          $query = "INSERT INTO {$table}(title, description, startTime, endTime, eDate, createTime, invitees) ";

          $query .= "VALUES('{$event_title}','{$event_desc}','{$start_time}','{$end_time}','{$event_date}','{$event_time}','{$event_inv}')";

          $create_event_query = $connection->query($query);

          confirmQuery($create_event_query);
          $last_id = $connection->insert_id;

          if($event_inv != ""){
            $inv_arr = explode(" ",$event_inv);
            foreach($inv_arr as $key=>$value){
                $table = $value."invites";

                $query = "SELECT * FROM $table";
                $table_check_query = $connection->query($query);
                if($table_check_query!==false && $value!=$_SESSION['curr_user']){
                  $query = "INSERT INTO $table(userId,userName,eventId,createTime) ";
                  $query .= "VALUES('{$_SESSION['curr_id']}','{$_SESSION['curr_user']}','{$last_id}','{$event_time}')";

                  $add_invitee_query = $connection->query($query);

                  confirmQuery($add_invitee_query);
                }


            }
          }


          redirect("home.php?date=$event_date");





   }




?>
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/navigation.php'); ?>

<div style="margin:0 auto;width: 80%;">

  <form action="" method="post">


    <div class="form-group">
       <label for="title">Event Title</label>
        <input type="text" class="form-control" name="title" required>
    </div>

    <div class="form-group">
       <label for="description">Description</label>
       <textarea class="form-control "name="description" cols="30" rows="10">
       </textarea>
    </div>

    <div class="form-group">
       <label for="invitees">Add Invitees</label>
       <input type="text" class="form-control" name="invitees" placeholder="Enter usernames with a space between each of them.">
       </textarea>
    </div>

    <div class="form-group">
        <label for="start_time">From</label>
        <input type="time" class="form-control" name="start_time" required>
        <label for="end_time">To</label>
        <input type="time" class="form-control" name="end_time" required>
    </div>

    <br />
     <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_event" value="Create Event">
    </div>


</form>

</div>
<footer style="text-align: center;">

        <div style"margin:0 auto;width: 80%;">
            Made with &#10084; by <a href="https://github.com/shakeabi">Abishake</a>
        </div>
</footer>

</div>



<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>
