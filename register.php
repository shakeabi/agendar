<?php

session_start();
include_once('config.php');
include_once('functions.php');

$_SESSION['message']="";
$_SESSION['e_message']="";

$db_username = null;
$db_password = null;
$db_id = null;


if(isset($_POST['register'])){

    $access=1;

    if(isset($_POST['g-recaptcha-response'])){
      //Checking recaptcha
      $url ='https://www.google.com/recaptcha/api/siteverify?secret=';
      $url .= $private_key."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR'];

      $response = file_get_contents($url);
      $data = json_decode($response);

      if(!((isset($data->success))AND($data->success==true))){
          $_SESSION['e_message'] = 'You failed the captcha!';
          $access=0;
      }
      // Recaptcha ends
    }
    else {
      $_SESSION['e_message']="Please Enter Captcha";
    }


    //Registering...
    $username = $connection->real_escape_string($_POST['usernamesignup']);

    $email = $_POST['emailsignup'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = $_POST['passwordsignup'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['e_message'] = 'Please enter a valid E-Mail address!';
        $access=0;
    }

    if(!preg_match("/^[a-zA-Z0-9_.-]*$/",$_POST['usernamesignup'])) {
        $_SESSION['e_message'] = 'Your username can only contain letters, numbers, underscore, point and hyphen!';
        $access=0;
    }

    if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$_POST['passwordsignup'])) {
        $_SESSION['e_message'] = 'Your password should contain minimum eight characters; at least a letter and a number!';
        $access=0;
    }


    if($access==1){

      //matching passwords
    	if($_POST["passwordsignup"]==$_POST["passwordsignup_confirm"]){

            //setting up session variable
            $_SESSION['curr_user'] = $username;

            $hashFormat = "$2y$10$";
            $salt = "agendarisawesomeuseitnow";
            $hashAndSalt = $hashFormat . $salt;
            $password = crypt($password, $hashAndSalt);


            $table = "users";

            $query = "INSERT INTO $table (username,email,password) ";
            $query .= "VALUES ('$username','$email','$password')";

            if($connection->query($query) === true){
                $query = "SELECT * FROM users";
                $result = $connection->query($query);

                while($row = $result->fetch_assoc()){
                  $db_username = $row['username'];
                  $db_password = $row['password'];
                  $db_id = $row['id'];

                  if($username == $db_username && $password == $db_password){
                    break;
                  }
                }

                $_SESSION['curr_id'] = $db_id;

                //creating personal tables..
                $tableName_events = $db_id."events";
                $query = "CREATE TABLE IF NOT EXISTS $tableName_events(
                		id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                		title VARCHAR(200) NOT NULL,
                		description TEXT NOT NULL,
                		startTime TIME NOT NULL,
                		endTime TIME NOT NULL,
                		eDate DATE NOT NULL,
                		createTime VARCHAR(1000) NOT NULL,
                    invited VARCHAR(1000),
                    invitees varchar(8000)
                		)";
                $connection->query($query);

                $tableName_invites = $db_username."invites";
                $query = "CREATE TABLE IF NOT EXISTS $tableName_invites(
                    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    userId INT(11) NOT NULL,
                    userName TEXT NOT NULL,
                    eventId INT(11) NOT NULL,
                    createTime VARCHAR(1000) NOT NULL
                    )";
                $connection->query($query);

                $_SESSION['message'] = "Registration succesful!";
                redirect("home.php");
    		     }
            else{
               	$_SESSION['message'] = 'User could not be added to the database!';
            }

    	}

    	else{
            $_SESSION['e_message'] = 'Your passwords do not match!';
        }

    }

}

?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8" >
        <title>Agendar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/calendar.png">
        <link rel="stylesheet" type="text/css" href="css/styley.css" >
        <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>

    </head>
    <body>
        <div class="container" >
            <header >
                <h1>Welcome to <span><strong>Agendar</strong></span></h1>
            </header>
            <section>
                <div id="container_inner" >
                    <div id="wrapper">
                      <div id="login" class="animate form">
                          <form  action="register.php" autocomplete="off" method="post">
                              <h1> Sign up </h1>
                              <p>
                                  <div id="error" style="color:red;text-align:center;border-radius:10px;"><?php echo $_SESSION['e_message'];?></div>
                              </p>
                              <p>
                                  <label for="usernamesignup" class="uname" ><i class="fa fa-user" aria-hidden="true" ></i> Your username <div id="u_error" style="text-align:center;border-radius:12px;"></div></label>
                                  <input id="usernamesignup" name="usernamesignup" type="text" placeholder="myusername" onkeyup="checkUsername(this.value);" onblur="usernameFocusOut();" required>
                              </p>
                              <p>
                                  <label for="emailsignup" class="youmail" ><i class="fa fa-envelope" aria-hidden="true"></i> Your email</label>
                                  <input id="emailsignup" name="emailsignup" type="email" placeholder="mymail@gmail.com"  required>
                              </p>
                              <p>
                                  <label for="passwordsignup" class="youpasswd" ><i class="fa fa-key" aria-hidden="true"></i> Your password </label>
                                  <input id="passwordsignup" name="passwordsignup" type="password" pattern=".{8,}" placeholder="atleast 8 characters"  required>
                              </p>
                              <p>
                                  <label for="passwordsignup_confirm" class="youpasswd" ><i class="fa fa-key" aria-hidden="true"></i> Please confirm your password </label>
                                  <input id="passwordsignup_confirm" name="passwordsignup_confirm" type="password" pattern=".{8,}" placeholder="atleast 8 characters; a letter and a number"  required>
                              </p>
                              <p>
                                  <div class="reCaptchaClass"><div class="g-recaptcha" data-sitekey="<?php echo $public_key; ?>" ></div></div>
                              </p>
                              <p class="signin button">
                                         <input type="submit" value="Sign up" name="register">
                              </p>
                              <p class="change_link">
                                         Already a member ?
                                        <a href="login.php" class="to_register"> Log in </a>
                              </p>
                          </form>
                      </div>
                    </div>
                </div>
            </section>

              <div class="foot" style="margin: 20px;">
                Made with &#10084; by <a href="https://github.com/shakeabi">Abishake</a>
              </div>
        </div>


        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="js/register.js"></script>
    </body>
</html>
