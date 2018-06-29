<?php

  include_once('functions.php');

  //recaptcha vars
  $public_key = "6LdgdmAUAAAAAMUB4oo4JS9bHGUUE80VsXEDBP_N";
  $private_key = "6LdgdmAUAAAAANc0Hm5XJXgDYUsqjs3PanssaPAT";

  define ('DB_HOST','localhost');
  define ('DB_USER','root');
  define ('DB_PASSWORD','');

  $connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD);

  $query = "CREATE DATABASE IF NOT EXISTS agendar";
  $connection->query($query);
  confirmQuery($connection);

  $query = "USE agendar";
  $connection->query($query);
  confirmQuery($connection);

  $query = "CREATE TABLE IF NOT EXISTS users(
  		id INT(11) NOT NULL AUTO_INCREMENT,
  		username VARCHAR(255) NOT NULL,
  		email VARCHAR(255) NOT NULL,
  		password VARCHAR(255) NOT NULL,
  		PRIMARY KEY (id,username)
  		)";
  $connection->query($query);
  confirmQuery($connection);



?>
