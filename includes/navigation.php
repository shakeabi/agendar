<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php"><span class="glyphicon glyphicon-calendar"></span> Agendar</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="home.php">Calendar</a>
                </li>
                <li>
                    <a href="invites.php">Invites</a>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="#"><?php echo $_SESSION['curr_user']; ?></a>
              </li>
              <li>
                <a href="#">ID: <?php echo $_SESSION['curr_id']; ?></a>
              </li>
              <li>
                  <a href="logout.php">Logout</a>
              </li>
            </ul>

        </div>

    </div>

</nav>
