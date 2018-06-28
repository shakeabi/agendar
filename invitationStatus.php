<?php
  include_once('config.php');
  include_once('functions.php');
  session_start();
  if(!isset($_SESSION['curr_id'])){header("Location: index.php");}

  if(isset($_GET['status']) AND isset($_GET['uId']) AND isset($_GET['eId']) AND isset($_GET['invId'])){
    $status = $_GET['status'];
    $u_id = $_GET['uId'];
    $e_id = $_GET['eId'];
    $inv_id = $_GET['invId'];

    if($status == 1){
      $table_temp = $u_id."events";
      $query_temp = "SELECT * FROM $table_temp WHERE id = $e_id";
      $result_temp = $connection->query($query_temp);
      confirmQuery($result_temp);
      $row_temp = $result_temp->fetch_assoc();

      $inv_e_title = $row_temp['title'];
      $inv_e_desc = $row_temp['description'];
      $inv_e_sTime = $row_temp['startTime'];
      $inv_e_eTime = $row_temp['endTime'];
      $inv_e_date = $row_temp['eDate'];
      $event_time = date("l jS \of F Y h:i:s A");

      $table = $_SESSION['curr_user'].'invites';

      $query = "SELECT userName FROM $table WHERE userId = $u_id";
      $result = $connection->query($query);
      confirmQuery($result_temp);
      $row_inv = $result->fetch_assoc();
      $invitedBy = $row_inv['userName'];

      $table_temp = $_SESSION['curr_id']."events";
      $query = "INSERT INTO {$table_temp}(title, description, startTime, endTime, eDate, createTime, invited) ";
      $query .= "VALUES('{$inv_e_title}','{$inv_e_desc}','{$inv_e_sTime}','{$inv_e_eTime}','{$inv_e_date}','{$event_time}','{$invitedBy}')";
      $result_temp = $connection->query($query);
      confirmQuery($result_temp);
    }



    $table = $_SESSION['curr_user']."invites";
    $query = "DELETE FROM $table WHERE id = $inv_id";
    $result = $connection->query($query);
    confirmQuery($result);


    redirect('invites.php');
  }

 ?>
